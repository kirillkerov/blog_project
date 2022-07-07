<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title', 'user_id', 'text'];
    public $timestamps = false;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPostComments()
    {
        return $this->comments()->orderByDesc('id')->get();
    }

    public static function getPosts($offset, $limit)
    {
        return self::orderBy('created_at', 'DESC')
            ->offset($offset)
            ->limit($limit)
            ->get();
    }

    public static function getPostsWithAutor($offset, $limit, $sort)
    {
        return self::addSelect(['user_email' => User::select('email')
            ->whereColumn('id', 'posts.user_id')
        ])->orderBy('id', $sort)
            ->offset($offset)
            ->limit($limit)
            ->get();
    }
}
