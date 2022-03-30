<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialForum extends Model
{
    use SoftDeletes;
    
    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->where('type', '0');
    }

    public function topiccomments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->where('type', '0')->where('status','1');
    }
}
