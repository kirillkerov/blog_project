<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */

class Group extends Model
{
    protected $table = 'groups';

    public function users()
    {
        return $this->hasMany(Group::class);
    }
}
