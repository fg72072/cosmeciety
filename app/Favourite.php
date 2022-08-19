<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    // 0 = barber
    // 1 = seller
    // 3 = product 

    function barber()
    {
        return $this->belongsTo(User::class, 'favourite_against', 'id')->whereHas('roles',function($q){
            $q->where('name','barber');
        });
    }

    function seller()
    {
        return $this->belongsTo(User::class, 'favourite_against', 'id')->whereHas('roles',function($q){
            $q->where('name','seller');
        });
    }

    function product()
    {
        return $this->belongsTo(Product::class, 'favourite_against', 'id');
    }
}
