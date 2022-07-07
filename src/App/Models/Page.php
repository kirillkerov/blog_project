<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */

class Page extends Model
{
    protected $fillable = ['name', 'title', 'text', 'user_id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getPages()
    {
        return self::addSelect(['user_email' => User::select('email')
            ->whereColumn('id', 'pages.user_id')
        ])->get();
    }
}
