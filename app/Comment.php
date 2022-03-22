<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // 0 = topic
    // 1 = post
    // 2 = contest
    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
