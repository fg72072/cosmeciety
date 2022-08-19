<?php

namespace App\Http\Controllers\Api\Barber;

use JWTAuth;
use App\User;
use App\Booking;
use App\Service;
use Carbon\Carbon;
use App\Transaction;
use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('service:id,title','user:id,img,name')->whereHas('service.barber',function($q){
            $q->where('user_id',JWTAuth::user()->id);
        })->get()->makeHidden(['service_total']);
        return response()->json([
            'success' => true,
            'bookings' => $bookings,
        ],200);
    }

    public function acceptOrReject($id,Request $req)
    {
        try{
            $booking = Booking::with('service.barber')->where('id',$id)->whereHas('service.barber',function($q){
                $q->where('user_id',JWTAuth::user()->id);
            })->first();
            
            if($booking){
                if($req->type == "accept"){
                    $booking->status = '1';
                    Notification::notification($booking->user_id,JWTAuth::user()->id,$booking->id,'Accept Booking',$booking->service->barber->name." has accepted your booking.",'1');
                }
                elseif($req->type == "reject"){
                    $booking->status = '2';
                    Notification::notification($booking->user_id,JWTAuth::user()->id,$booking->id,'Reject Booking',$booking->service->barber->name." has rejected your booking.",'1');
                }
                $booking->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Booking Updated Successfully.',
                ],200);
               
            }
            }
            catch(\Exception $e){
                return response()->json(['success'=>false,'data'=>'something goes wrong'],400);
        }
    }
}
