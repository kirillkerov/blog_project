<?php

namespace App\Controllers;

use App\Config;
use App\View\View;
use App\Models\Post;
use yidas\data\Pagination;

class HomeController
{
    public function index()
    {
        $config = Config::getInstance()->get('config');

        $pagination = new Pagination([
            'totalCount' => Post::count(),
            'perPage' => $config['mainPagino'],
        ]);

        return new View('homepage', [
            'title' => 'Главная страница',
            'posts' => Post::getPosts($pagination->offset, $pagination->limit),
            'pagination' => $pagination,
        ]);
    }
}
