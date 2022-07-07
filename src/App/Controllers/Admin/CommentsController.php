<?php

namespace App\Controllers\Admin;

use App\Models\Comment;
use App\Models\User;
use App\Service\CommentService;
use App\View\JsonResponse;
use App\View\View;
use Exception;

class CommentsController extends AbstractAdminController
{
    public function comments(): View
    {
        return new View('/admin/comments', [
            'comments' => Comment::getComments(),
            'nav' => $this->getNav($this->nav['comments']),
        ]);
    }

    public function moderation(): JsonResponse
    {
        try {
            CommentService::moderation($_POST['id']);
            $response = [
                'message' => 'Принято',
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

    public function delete(): JsonResponse
    {
        try {
            CommentService::delete($_POST['id']);
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
