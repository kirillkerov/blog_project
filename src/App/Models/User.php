<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */

class User extends Model
{
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = ['first_name', 'second_name', 'about', 'is_mailing'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public static function countManagers(): int
    {
        return self::where('group_id', 2)->count();
    }

    public static function countAdmins(): int
    {
        return self::where('group_id', 1)->count();
    }

    public static function lastUsers($count)
    {
        return self::orderByDesc('id')->limit($count)->get();
    }

    public static function getUsers()
    {
        return self::addSelect(['group' => Group::select('name')
            ->whereColumn('id', 'users.group_id')
        ])->orderByDesc('id')->get();
    }
}
