<?php

namespace App\Service;

use App\Exception\IncorrectFileException;
use App\Exception\InvalidArgumentException;
use App\Models\User;

class UserService
{
    public static function login(array $user): int
    {
        $existUser = User::whereEmail($user['email'])->first();
        if (!$existUser) {
            throw new InvalidArgumentException('Пользователь с таким email не найден');
        }

        if (!password_verify($user['password'], $existUser['password'])) {
            throw new InvalidArgumentException('Неверный пароль');
        }

        $_SESSION['user'] = [
            'id' => $existUser['id'],
            'name' => $existUser['first_name'],
            'email' => $existUser['email'],
            'group' => $existUser['group_id'],
        ];

        return $existUser['group_id'] ?? 0;
    }

    public static function registration(array $data): bool
    {
        if (User::whereEmail($data['email'])->first()) {
            throw new InvalidArgumentException('Пользователь с таким email уже зарегистрирован');
        }

        if ($data['password1'] !== $data['password2']) {
            throw new InvalidArgumentException('Пароли не совпадают');
        }

        $_SESSION['user']['id'] = User::insertGetId([
            'first_name' => $data['firstName'],
            'second_name' => $data['secondName'],
            'email' => $data['email'],
            'password' => password_hash($data['password1'], PASSWORD_DEFAULT)
        ]);
        $_SESSION['user']['name'] = $data['firstName'];
        $_SESSION['user']['group'] = NULL;

        return true;
    }

    public static function update($user): array
    {
        $access = [];
        $error = [];

        if (isset($_POST['newUserData'])) {
            $mailing = isset($_POST['mailing']) ? '1' : '0';
            $user->fill([
                'first_name' => $_POST['firstName'],
                'second_name' => $_POST['secondName'],
                'about' => $_POST['about'],
                'is_mailing' => $mailing,
            ]);
            $_SESSION['user']['name'] = $_POST['firstName'];
        }

        if (isset($_POST['newUserPassword'])) {
            try {
                if (!password_verify($_POST['currentPassword'], $user['password'])) {
                    throw new InvalidArgumentException('Неверный текущий пароль!');
                }
                if ($_POST['newPassword1'] !== $_POST['newPassword2']) {
                    throw new InvalidArgumentException('Пароли не совпадают!');
                }

                $user->password = password_hash($_POST['newPassword1'], PASSWORD_DEFAULT);
                $access['password'] = 'Пароль успешно изменён!';
            } catch (InvalidArgumentException $e) {
                $error['password'] = $e->getMessage();
            }
        }

        if (isset($_POST['newUserPhoto'])) {
            if ($_FILES['userPhoto']['error'] === 0) {
                try {
                    $newImg = $user['id'] . '_photo_' . basename($_FILES['userPhoto']['name']);
                    $uploadFile = IMG_DIR . 'users/' . $newImg;

                    if ($_FILES['userPhoto']['size'] > 5000000) {
                        throw new IncorrectFileException('Размер файла превышает 5Мб');
                    }

                    if (!in_array(mime_content_type($_FILES['userPhoto']['tmp_name']), ['image/jpg', 'image/jpeg', 'image/png'])) {
                        throw new IncorrectFileException('Неподдерживаемый формат изображения');
                    }

                    if (move_uploaded_file($_FILES['userPhoto']['tmp_name'], $uploadFile)) {
                        $user->img = $newImg;
                    }
                } catch (IncorrectFileException $e) {
                    $error['img'] = $e->getMessage();
                }
            } else {
                $error['img'] = 'Произошла ошибка при загрузке изображения!';
            }
        }
        $user->save();

        return ['access' => $access, 'error' => $error];
    }
}
