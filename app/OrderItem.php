<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    function product()
    {
        return $this->belongsTo(Product::class, 'p_id', 'id');
    }
}
