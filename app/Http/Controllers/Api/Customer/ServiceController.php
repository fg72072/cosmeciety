<?php

namespace App\Http\Controllers\Api\Customer;

use App\Booking;
use JWTAuth;
use App\User;
use DateTime;
use App\Service;
use App\Mail\OTP;
use Carbon\Carbon;
use App\WorkingDay;
use App\Otp as AppOtp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ServiceController extends Controller
{
    public function barber(Request $req)
    {
        $barbers = User::where('name', 'like', '%' . $req->title . '%')->whereHas('roles', function ($q) {
            $q->where('name', 'barber');
        })->get()->makeHidden(['email','email_verified_at']);

        return response()->json([
            'success' => true,
            'barbers' => $barbers,
        ], 200);
    }
    public function showBarber($id)
    {
        $barber = User::with('workingdays.day','favourite')->whereHas('roles', function ($q) {
            $q->where('name', 'barber');
        })->where('id', $id)->first()->makeHidden(['email','email_verified_at']);

        if ($barber) {
            return response()->json([
                'success' => true,
                'barber' => $barber,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'not found',
            ], 404);
        }
    }

    public function showBarberService(Request $req,$id)
    {
        $services = Service::where('user_id', $id);
        if($req->sort_type == 'high'){
            $services = $services->orderBy('price','desc');
        }
        if($req->sort_type == 'low'){
            $services = $services->orderBy('price','asc');
        }
        $services = $services->get();
            return response()->json([
                'success' => true,
                'services' => $services,
            ], 200);
    }

    public function availableSlots($id,Request $req)
    {
        // $myDate = '12/08/2020';
        $service = Service::where('id',$id)->first();
        $barber = User::find($service->user_id);
        $day = Carbon::createFromFormat('d/m/Y', $req->date)->format('l');
       
   
        $workingday = WorkingDay::where('user_id',$service->user_id)->whereHas('day',function($q) use($day){
            $q->where('title',$day);
        })->first();
  
        $occupied = Booking::whereHas('service.barber',function($q) use($req,$service){
            $q->where('user_id',$service->user_id)->where('date',$req->date);
        })->get();
        
        $begin = new DateTime($workingday->open);
        $end = new DateTime($workingday->close);
        $slots = [];
        $date = Carbon::now();
        $checkdate1 = Carbon::createFromFormat('d/m/Y', $date->format('d/m/Y'));
        $checkdate2 = Carbon::createFromFormat('d/m/Y', $req->date);
        if($end < $begin){
            $date1 = Carbon::createFromFormat('d/m/Y h:i a', $req->date.' '.$begin->format('h:i a'));
            $date2 = Carbon::createFromFormat('d/m/Y h:i a',$req->date.' '.$end->format('h:i a'),'Asia/Karachi')->addDay(1);
            $diff_in_hours = $date1->diffInHours($date2);
          for($i=0;$i < ($diff_in_hours * 2);$i++){
            $output = $begin->format('h:i a');
            // $output = $begin->format('H:i A') . " - ";
            $checktime1 = Carbon::createFromFormat('h:i a', $output);
            $begin->modify('+30 minutes');          /** Note, it modifies time by 30 minutes */
            // $output .= $begin->format('H:i A');
            // $end_time = Carbon::parse($output)->addMinutes($service->duration - 30)->format('h:i a');
                if($begin->format('a') == 'pm' && $checkdate1->eq($checkdate2) && $checktime1->lt($date->format('h:i a'))){
                    
                }
          
              else{
     
                $slots[] = $output;
             }
           
           
          }
        }
        else{


            while($begin < $end) {
            $output = $begin->format('h:i a');
            $checktime = Carbon::createFromFormat('h:i a', $output);
            $begin->modify('+30 minutes');          /** Note, it modifies time by 15 minutes */
            //  $end_time = Carbon::parse($output)->addMinutes($service->duration )->format('h:i a');
             if($checkdate1->eq($checkdate2) && $checktime->lt($date->format('h:i a'))){
                //   return $output .' dfsadf '.$date->format('h:i a');
             }
             else{
               
                $slots[] = $output;
             }
        }
            
        }
 

        $bookeds = array();
        $counts = 0;
        foreach($occupied as $occ){
            $booked_begin = new DateTime($occ->from_time);
            $booked_end = new DateTime($occ->to_time);
            $i = 0;
            if($booked_end < $booked_begin){
                $date1 = Carbon::createFromFormat('d/m/Y h:i a', $req->date.' '.$begin->format('h:i a'));
                $date2 = Carbon::createFromFormat('d/m/Y h:i a',$req->date.' '.$end->format('h:i a'),'Asia/Karachi')->addDay(1);
                $diff_in_hours = $date1->diffInHours($date2);
               for($i=0;$i < ($diff_in_hours * 2);$i++){
             
                $booked = $booked_begin->format('h:i a');
                // $output = $begin->format('H:i A') . " - ";
                $booked_begin->modify('+30 minutes');          /** Note, it modifies time by 15 minutes */
                // $output .= $begin->format('H:i A');
                // $bookeds[$i+=1] = $booked;
                array_push($bookeds, $booked);
                // array_push($bookeds, $booked);
                $counts = array_count_values($bookeds);
               
               }
            }
            else{
                while($booked_begin < $booked_end) {
                $booked = $booked_begin->format('h:i a');
                // $output = $begin->format('H:i A') . " - ";
                $booked_begin->modify('+30 minutes');          /** Note, it modifies time by 15 minutes */
                // $output .= $begin->format('H:i A');
                // $bookeds[$i+=1] = $booked;
              
                    array_push($bookeds, $booked);
                    // array_push($bookeds, $booked);
                    $counts = array_count_values($bookeds);

          
            }  
            }
        }
        foreach($bookeds as $bo){
            $key = array_search($bo, $slots);
            if (false !== $key) {
                if($counts[$bo] >= $barber->seats){
                    unset($slots[$key]);
                }
            }
        }
       
    //   if($slots){
    //           $slots = array_combine(range(0, 
    //             count($slots) + (0-1)),
    //             array_values($slots));  
    //   }
  

        if($workingday->open && $workingday->status == '1'){
            if( (int)$barber->seats >= 1){
                $service->slots = $slots;
            }
            else{
                $service->slots = [];
            }
        }
        else{
            $service->slots = [];
        }
        return response()->json([
            'success' => true,
            'service' => $service,
        ], 200);
    }

}
