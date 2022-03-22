<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    
    // 0 = order
    // 1 = booking
    // 2 = contest

    public function getTypeAttribute($value)
    {
        $type = '';
        if($value == 0){
            $type = 'Order';
        }
        elseif($value == 1){
            $type = 'Booking';
        }
        elseif($value == 2){
            $type = 'Contest';
        }
        return $type;
    }
}
