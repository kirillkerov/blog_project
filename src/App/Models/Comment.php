<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */

class Comment extends Model
{
    protected $fillable = ['user_id', 'post_id', 'text'];
    public $timestamps = false;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getComments()
    {
        return self::addSelect(['user_email' => User::select('email')
            ->whereColumn('id', 'comments.user_id')
        ])->orderByDesc('created_at')->get();
    }

    public static function getCommentsForModeration()
    {
        return self::addSelect(['user_email' => User::select('email')
            ->whereColumn('id', 'comments.user_id')
        ])->where('moderation', 0)->orderByDesc('created_at')->get();
    }
}
