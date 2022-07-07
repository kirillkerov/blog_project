<?php

namespace App\Controllers\Admin;

use App\Config;
use App\Models\Comment;
use App\Models\Page;
use App\Models\User;
use App\View\View;

class PanelController extends AbstractAdminController
{
    public function panel(): View
    {
        $mainPagino = Config::getInstance()->get('config')['mainPagino'];

        if (isset($_POST['mainPagino'])) {
            if ($_POST['mainPagino'] > 5) {
                correctConfig('mainPagino', $_POST['mainPagino']);
                $mainPagino = $_POST['mainPagino'];
            }
        }

        $users = [
            'countUsers' => User::count(),
            'countManagers' => User::countManagers(),
            'countAdmins' => User::countAdmins(),
            'lastUsers' => User::lastUsers(3),
        ];

        return new View('/admin/panel', [
            'user' => $this->user,
            'users' => $users,
            'thisUserPosts' => $this->user->posts()->orderByDesc('id')->limit(3)->get(),
            'commentsNeedsModeration' => Comment::getCommentsForModeration(),
            'staticPages' => Page::getPages(),
            'nav' => $this->getNav($this->nav['panel']),
            'mainPagino' => $mainPagino,
        ]);
    }
}
