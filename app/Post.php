<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->where('type', '1');
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'post_id', 'id');
    }
}
