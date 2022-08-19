<?php

namespace App\Http\Controllers\Api\Customer;

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
        $bookings = Booking::with('service:id,title','user:id,img,name')->where('user_id',JWTAuth::user()->id)->get()->makeHidden(['service_total']);
        return response()->json([
            'success' => true,
            'bookings' => $bookings
        ]);
    }
    public function store(Request $req)
    {
        $validate = Request()->validate([
            'service_id' => 'required',
            'date' => 'required',
            'from_time' => 'required',
        ]);
        try{
            $service = Service::find($req->service_id);
            if($service){
            // $decimalHours = $service->duration;
            // $hours = floor($decimalHours);
            // $mins = round(($decimalHours - $hours) * 60);
            // $timeInMinutes = ($hours * 60) + $mins;
            
            $timeInMinutes = $service->duration;

            $booking = new Booking;
            $booking->user_id = JWTAuth::user()->id;
            $booking->customer_name = $req->customer_name;
            $booking->service_id = $service->id;
            $booking->service_price = $service->price;
            $booking->service_total = $service->price;
            $booking->date = $req->date;
            $booking->from_time = $req->from_time;
            $booking->to_time = Carbon::parse($req->from_time)->addMinutes($timeInMinutes)->format('h:i a');
            if($booking->save()){
                    Transaction::transaction($booking->id,'5435243524352',$service->price,'',1);
                    Notification::notification($service->user_id,JWTAuth::user()->id,$booking->id,'Booking',JWTAuth::user()->name.' has place a booking.','1');
                    return response()->json([
                        'success' => true,
                        'message' => 'booking placed successfully.',
                    ],200);
                }
            }
            else{
                return response()->json(['success'=>false,'message'=>'service not found'],404);
                }
            }
            catch(\Exception $e){
                return response()->json(['success'=>false,'data'=>$e],400);
        }
    }
}
