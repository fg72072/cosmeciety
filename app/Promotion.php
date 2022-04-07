<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //
    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function medias()
    {
        return $this->hasMany(Media::class, 'media_against', 'id')->where('type', '5');
    }
}
