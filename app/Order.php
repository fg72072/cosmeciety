<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    
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

    function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
