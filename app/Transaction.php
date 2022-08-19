<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JWTAuth;
class Transaction extends Model
{
    use SoftDeletes;
    
    // 0 = order
    // 1 = booking
    // 2 = contest
    
    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

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

    public static function transaction($payment_against,$txn_id,$amount,$description,$type)
    {
        $trans = new Transaction;
        $trans->user_id = JWTAuth::user()->id;
        $trans->payment_againts = $payment_against;
        $trans->txn_id = $txn_id;
        $trans->amount = $amount;
        $trans->description = $description;
        $trans->type = $type;
        return $trans->save();
    }
}
