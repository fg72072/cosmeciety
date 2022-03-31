<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->where('type', '1');
    }

    public function postcomments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->where('type', '1')->where('status','1')->where('parent','0');
    }

    public function medias()
    {
        return $this->hasMany(Media::class, 'media_against', 'id')->where('type', '2');
    }


    public function like()
    {
        return $this->hasMany(Like::class, 'post_id', 'id');
    }
}
