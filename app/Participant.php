<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    //
    use SoftDeletes;

    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    function media()
    {
        return $this->hasMany(Media::class, 'media_against', 'id')->where('type', '4');
    }
    function vote()
    {
        return $this->hasMany(Vote::class, 'participate_id', 'id');
    }
    public function feedbacks()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id')->where('comments.type', '2')->where('comments.status','1');
    }
    public function contest()
    {
        return $this->belongsTo(Contest::class, 'contest_id', 'id');
    }

}
