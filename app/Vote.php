<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model
{
    //
    // use SoftDeletes;

    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
