<?php

namespace App\Controllers\Admin;

use App\Exception\InvalidArgumentException;
use App\Models\Page;
use App\Models\User;
use App\Service\PageService;
use App\View\JsonResponse;
use App\View\View;

class PagesController extends AbstractAdminController
{
    public function pages(): View
    {
        return new View('/admin/pages', [
            'staticPages' => Page::getPages(),
            'thisUserEmail' => $this->user->email,
            'nav' => $this->getNav($this->nav['pages']),
        ]);
    }

    public function create(): View
    {
        if (!empty($_POST)) {
            try {
                $result = PageService::create($this->user['id']);
                $_SESSION['result'] = $result;
                $this->redirect('/admin/pages');
            } catch (InvalidArgumentException $e) {
                $error = $e->getMessage();
            }
        }

        return new View('/admin/page_service', [
            'action' => 'create',
            'error' => $error ?? '',
            'nav' => $this->getNav($this->nav['createPage']),
        ]);
    }

    public function update(int $id): View
    {
        $currentPage = Page::find($id);

        if (!empty($_POST)) {
            try {
                $result = PageService::update($id);
                $_SESSION['result'] = $result;
                $this->redirect('/admin/pages');
            } catch (InvalidArgumentException $e) {
                $error = $e->getMessage();
            }
        }

        return new View('/admin/page_service', [
            'action' => 'update',
            'error' => $error ?? '',
            'currentPage' => $currentPage,
            'nav' => $this->getNav($this->nav['createPage']),
        ]);
    }

    public function delete(): JsonResponse
    {
        try {
            $response = [
                'result' => PageService::delete($_POST['name']),
            ];
        } catch (\Exception $e) {
            $response = [
                'message' => $e->getMessage(),
                'result' => false,
            ];
        }
        return new JsonResponse($response);
    }
}
