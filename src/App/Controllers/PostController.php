<?php

namespace App\Controllers;

use App\Models\Post;
use App\View\View;

class PostController
{
    public function post(int $id): View
    {
        $post = Post::find($id);
        $comments = $post->getPostComments();
        foreach ($comments as $key => $comment) {
            if (!$comment['moderation'] && $comment['user']['email'] !== $_SESSION['user']['email']) {
                unset($comments[$key]);
            }
        }

        return new View('post', ['post' => $post, 'comments' => $comments]);
    }
}
