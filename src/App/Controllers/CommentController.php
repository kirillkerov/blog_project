<?php

namespace App\Controllers;

use App\Models\Comment;

class CommentController extends AbstractPrivateController
{
    public function comment($postId)
    {
        $comment = new Comment;
        $comment->fill([
            'user_id' => $this->user['id'],
            'post_id' => $postId,
            'text' => $_POST['comment'],
        ]);
        if (in_array($this->user['group_id'], [1, 2])) {
            $comment->moderation = 1;
        }
        $comment->save();

        $this->redirect('/post/' . $postId);
    }
}
