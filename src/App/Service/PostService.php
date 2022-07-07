<?php

namespace App\Service;

use App\Exception\IncorrectFileException;
use App\Models\Post;

class PostService
{
    public static function create($user): array
    {
        $post = new Post;
        $post->fill([
            'title' => $_POST['title'],
            'user_id' => $user['id'],
            'text' => $_POST['text'],
        ]);

        if (!empty($_FILES)) {
            self::loadFile($post);
        }

        $post->save();

        return [
            'action' => 'created',
            'id' => $post['id'],
            'title' => $post['title'],
        ];
    }

    public static function update($id): array
    {
        $currentPost = Post::find($id);

        if ($currentPost->title !== $_POST['title']) {
            $currentPost->title = $_POST['title'];
        }

        if ($currentPost->text !== $_POST['text']) {
            $currentPost->text = $_POST['text'];
        }

        if (!empty($_FILES)) {
            self::loadFile($currentPost);
        }

        $currentPost->save();

        return [
            'action' => 'updated',
            'id' => $currentPost['id'],
            'title' => $currentPost['title'],
        ];
    }

    public static function delete($id): bool
    {
        $post = Post::destroy($id);
        if (!$post) {
            throw new \Exception('Пост не найден');
        }

        return true;
    }

    private static function loadFile($post): bool
    {
        if ($_FILES['img']['size'] > 0 && $_FILES['img']['error'] === 0) {
            $img = $post->id . '_img_' . basename($_FILES['img']['name']);
            $uploadFile = IMG_DIR . 'posts/' . $img;

            if ($_FILES['img']['size'] > 5000000) {
                throw new IncorrectFileException('Размер файла превышает 5Мб');
            }

            if (!in_array(mime_content_type($_FILES['img']['tmp_name']), ['image/jpg', 'image/jpeg', 'image/png'])) {
                throw new IncorrectFileException('Неподдерживаемый формат изображения');
            }

            if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
                $post->img = $img;
                return true;
            }

            return false;
        }

        return true;
    }
}
