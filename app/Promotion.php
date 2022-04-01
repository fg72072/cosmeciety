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
}
