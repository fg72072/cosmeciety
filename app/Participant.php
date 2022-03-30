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
}
