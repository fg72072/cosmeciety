<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    // 0 normal 
    // 1 booking

    function fromuser()
    {
        return $this->belongsTo(User::class, 'from_user', 'id');
    }

    public static function notification($user_id,$from_user,$notification_against,$title,$description,$type)
    {
        $noti = new Notification;
        $noti->user_id = $user_id;
        $noti->from_user = $from_user;
        $noti->notification_against = $notification_against;
        $noti->title = $title;
        $noti->description = $description;
        $noti->type = $type;
        $noti->save();
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class,'notification_against','id')->where('type','0');
    }
}
