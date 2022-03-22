<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    // 0 = topic
    // 1 = post
    // 2 = contest
    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
