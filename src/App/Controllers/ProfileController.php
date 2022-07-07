<?php

namespace App\Controllers;

use App\View\View;
use App\Service\UserService;
use App\Models\Comment;

class ProfileController extends AbstractPrivateController
{
    public function profile($id): View
    {
        if ($this->user['id'] != $id) {
            $this->redirect('/profile/' . $this->user['id'], 'Вам не доступен чужой профиль');
        }

        $update = [];
        if (isset($_POST['newUserData']) || isset($_POST['newUserPassword']) || isset($_POST['newUserPhoto'])) {
            $update = UserService::update($this->user);
        }

        $group = $this->user->group['name'] ?? '';

        return new View('userpage', [
            'user' => $this->user,
            'group' => $group,
            'update' => $update,
        ]);
    }

    public function logout()
    {
        unset($_SESSION['user']);
        $this->redirect('/');
    }
}
