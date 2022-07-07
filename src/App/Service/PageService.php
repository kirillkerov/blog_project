<?php

namespace App\Service;

use App\Models\Page;
use App\Exception\InvalidArgumentException;

class PageService
{
    public static function create(int $creatorId): array
    {
        if (Page::whereName($_POST['name'])->first()) {
            throw new InvalidArgumentException('Страница с таким именем уже существует');
        }

        $page = new Page;
        $page->fill([
            'name' => $_POST['name'],
            'title' => $_POST['title'],
            'text' => $_POST['text'],
            'user_id' => $creatorId,
        ]);
        $page->save();

        return [
            'action' => 'created',
            'pageName' => $page['name'],
        ];
    }

    public static function update(int $id): array
    {
        $currentPage = Page::find($id);

        if (($currentPage['name'] !== $_POST['name']) && Page::whereName($_POST['name'])->first()) {
            throw new InvalidArgumentException('Страница с таким именем уже существует');
        }

        $currentPage->fill([
            'name' => $_POST['name'],
            'title' => $_POST['title'],
            'text' => $_POST['text'],
        ]);
        $currentPage->save();

        return [
            'action' => 'updated',
            'pageName' => $currentPage['name'],
        ];
    }

    public static function delete($name): bool
    {
        if (!(Page::whereName($name)->delete())) {
            throw new \Exception('Страница не найдена');
        }

        return true;
    }
}
