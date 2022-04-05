<?php

namespace App\Http\Controllers\Api;

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
        return response()->json([
            'success' => true,
            'notifications' => $noti,
        ], 200);
    }
}
