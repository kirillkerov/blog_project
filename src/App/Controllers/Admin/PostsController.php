<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Service\PostService;
use App\View\JsonResponse;
use App\View\View;
use Exception;
use yidas\data\Pagination;

class PostsController extends AbstractAdminController
{
    public function posts(): View
    {
        $pagination = new Pagination([
            'totalCount' => Post::count(),
            'perPage' => 10,
        ]);

        $sort = $_GET['sort'] ?? 'DESC';

        return new View('/admin/posts', [
            'posts' => Post::getPostsWithAutor($pagination->offset, $pagination->limit, $sort),
            'pagination' => $pagination,
            'thisUserEmail' => $this->user->email,
            'nav' => $this->getNav($this->nav['posts']),
        ]);
    }

    public function create(): View
    {
        if (isset($_POST['create'])) {
            try {
                $result = PostService::create($this->user);
                $_SESSION['result'] = $result;
                $this->redirect('/admin/posts');
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        return new View('/admin/post_service', [
            'form' => [
                'title' => $_POST['title'] ?? '',
                'img' => '',
                'postId' => '',
                'text' => $_POST['text'] ?? '',
                'btn' => 'Опубликовать',
                'action' => 'create',
            ],
            'nav' => $this->getNav($this->nav['createPost']),
            'error' => $error ?? '',
        ]);
    }

    public function update(int $id = null): View
    {
        if (isset($_POST['update'])) {
            try {
                $result = PostService::update($_POST['id']);
                $_SESSION['result'] = $result;
                $this->redirect('/admin/posts');
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        $currentPost = Post::find($id ?? $_POST['id']);

        return new View('/admin/post_service', [
            'form' => [
                'title' => $_POST['title'] ?? $currentPost['title'],
                'img' => $currentPost['img'],
                'postId' => $currentPost['id'],
                'text' => $_POST['text'] ?? $currentPost['text'],
                'btn' => 'Сохранить',
                'action' => 'update',
            ],
            'nav' => $this->getNav($this->nav['updatePost']),
            'error' => $error ?? '',
        ]);
    }

    public function delete(): JsonResponse
    {
        try {
            PostService::delete($_POST['id']);
            $response = [
                'message' => 'Удалено',
                'result' => true,
            ];
        } catch (Exception $e) {
            $response = [
                'message' => $e->getMessage(),
                'result' => false,
            ];
        }
        return new JsonResponse($response);
    }
}
