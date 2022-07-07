<?php

namespace App\Controllers\Admin;

use App\Controllers\AbstractPrivateController;

class AbstractAdminController extends AbstractPrivateController
{
    protected array $nav = [
        'panel' => [
            'name' => 'Панель администратора',
            'link' => '/admin',
            'parent' => null,
        ],
        'comments' => [
            'name' => 'Комментарии',
            'link' => '/admin/comments',
            'parent' => 'panel',
        ],
        'users' => [
            'name' => 'Пользователи',
            'link' => '/admin/users',
            'parent' => 'panel',
        ],
        'posts' => [
            'name' => 'Статьи',
            'link' => '/admin/posts',
            'parent' => 'panel',
        ],
        'createPost' => [
            'name' => 'Создать новую статью',
            'link' => '/admin/posts/create',
            'parent' => 'posts',
        ],
        'updatePost' => [
            'name' => 'Редактировать статью',
            'link' => '/admin/posts/update',
            'parent' => 'posts',
        ],
        'pages' => [
            'name' => 'Статичные страницы',
            'link' => '/admin/pages',
            'parent' => 'panel',
        ],
        'createPage' => [
            'name' => 'Создать новую страницу',
            'link' => '/admin/pages/create',
            'parent' => 'pages',
        ],
    ];

    protected function getNav(array $page): array
    {
        $nav = [$page];
        while ($nav[0]['parent']) {
            array_unshift($nav, $this->nav[$nav[0]['parent']]);
        }

        return $nav;
    }

    protected function redirect($url, $result = null)
    {
        if ($result) {
            $_SESSION['result'] = $result;
        }
        header('Location: ' . $url);
        exit;
    }
}
