<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // 0 = pending 
    // 1 = accept
    // 2 = reject 
    function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
