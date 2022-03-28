<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    //
    function barber()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
