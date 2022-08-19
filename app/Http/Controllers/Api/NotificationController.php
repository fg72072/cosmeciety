<?php

namespace App\Http\Controllers\Api;

use App\Booking;
use Carbon\Carbon;
use App\SocialForum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;
use JWTAuth;


class NotificationController extends Controller
{
    public function index(Request $req)
    {
        $noti = Notification::with('fromuser:id,name,img')->where('user_id',JWTAuth::user()->id)->get();
        foreach($noti as $n){
            if($n->type == '1'){
                $n->booking = Booking::with('service:id,title')->find($n->notification_against);
            }
            else{
                $n->booking = [];
            }
        }
        return response()->json([
            'success' => true,
            'notifications' => $noti,
        ], 200);
    }
}
