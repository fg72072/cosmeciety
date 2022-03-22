<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialForum extends Model
{
    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->where('type', '0');
    }
}
