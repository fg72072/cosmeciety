<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    function barber()
    {
        return $this->belongsTo(User::class, 'saloon_id', 'id')->whereHas('roles',function($q){
            $q->where('name','barber');
        });
    }
}
