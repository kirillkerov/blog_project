<?php

namespace App\Service;

use App\Models\Comment;

class CommentService
{
    public static function moderation($id): bool
    {
        $comment = Comment::find($id);
        if (!$comment) {
            throw new \Exception('Комментарий не найден');
        }

        $comment->moderation = 1;
        $comment->save();

        return true;
    }

    public static function delete($id): bool
    {
        $comment = Comment::destroy($id);
        if (!$comment) {
            throw new \Exception('Комментарий не найден');
        }

        return true;
    }
}
