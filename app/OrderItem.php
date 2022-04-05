<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;
    
    function product()
    {
        return $this->belongsTo(Product::class, 'p_id', 'id');
    }

    function deliveryStatus()
    {
        return $this->belongsTo(DeliveryStatus::class, 'status', 'id');
    }
}
