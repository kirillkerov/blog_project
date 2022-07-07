<?php

namespace App\Controllers;

use App\Exception\NotFoundException;
use App\Models\Page;
use App\View\View;
use App\Models\Post;

class StaticPageController
{
    public function show(string $name): View
    {
        $page = Page::whereName($name)->first();
        if (!$page) {
            throw new NotFoundException();
        }

        return new View('static_page', [
            'title' => $page['title'],
            'text' => $page['text'],
        ]);
    }

    public function policy(): View
    {
        return new View('policy', ['title' => 'Политика конфиденциальности']);
    }
}
