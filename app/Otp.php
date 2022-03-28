<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Otp extends Model
{
    use SoftDeletes;
    // 0 = login
    // 1 = forgot

    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
