<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    function deliveryStatus()
    {
        return $this->belongsTo(DeliveryStatus::class, 'status', 'id');
    }
}
