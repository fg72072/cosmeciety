<?php

namespace App\Http\Controllers\Api\Barber;

use JWTAuth;
use App\User;
use App\Booking;
use App\Service;
use Carbon\Carbon;
use App\WorkingDay;
use App\Transaction;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OccupancyController extends Controller
{
    public function index(Request $req)
    {
        $req->validate([
            'time' => 'required',
        ]);

        $barber = JWTAuth::user();
        $day = Carbon::createFromFormat('d/m/Y',$req->date,'Asia/Karachi')->format('l');

        $date = Carbon::createFromFormat('d/m/Y',$req->date,'Asia/Karachi')->format('d/m/Y');
        $workingday = WorkingDay::where('user_id',$barber->id)->whereHas('day',function($q) use($day){
            $q->where('title',$day);
        })->first();
        $occupied = Booking::whereHas('service.barber',function($q) use($date,$barber){
            $q->where('user_id',$barber->id)->where('date',$date);
        })->get();
        
        $begin = new DateTime($workingday->open);
        $end = new DateTime($workingday->close);
        $current_date = Carbon::now();
        $checkdate1 = Carbon::createFromFormat('d/m/Y', $current_date->format('d/m/Y'));
        $checkdate2 = Carbon::createFromFormat('d/m/Y', $req->date);
        $slots = [];
            if($end < $begin){
            $date1 = Carbon::createFromFormat('d/m/Y h:i a', $req->date.' '.$begin->format('h:i a'));
            $date2 = Carbon::createFromFormat('d/m/Y h:i a',$req->date.' '.$end->format('h:i a'),'Asia/Karachi')->addDay(1);
            $diff_in_hours = $date1->diffInHours($date2);
           for($i=0;$i < ($diff_in_hours * 2);$i++){
            $output = $begin->format('h:i a');
             $checktime1 = Carbon::createFromFormat('h:i a', $output);
            // $output = $begin->format('H:i A') . " - ";
            $begin->modify('+30 minutes');          /** Note, it modifies time by 15 minutes */
            // $output .= $begin->format('H:i A');
            
            if($req->type){
                if($begin->format('a') == 'pm' && $checkdate1->eq($checkdate2) && $checktime1->lt($current_date->format('h:i a'))){
                    
                }
          
              else{
     
                $slots[] = $output;
             }
            }
            else{
                $slots[] = $output; 
            }
           }
        }
        else{
        while($begin < $end) {
            $output = $begin->format('h:i a');
            // $output = $begin->format('H:i A') . " - ";
             $checktime = Carbon::createFromFormat('h:i a', $output);
            $begin->modify('+30 minutes');          /** Note, it modifies time by 15 minutes */
            // $output .= $begin->format('H:i A');
             if($req->type){
            if($checkdate1->eq($checkdate2) && $checktime->lt($current_date->format('h:i a'))){
                //   return $output .' dfsadf '.$date->format('h:i a');
             }
             else{
               
                $slots[] = $output;
             }
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
        // foreach($bookeds as $bo){
        //     $key = array_search($bo, $slots);
        //     if (false !== $key) {
        //         if($counts[$bo] >= $barber->seats){
        //             unset($slots[$key]);
        //         }
        //     }
        // }
        if($workingday->open && $workingday->status == '1'){
            if( (int)$barber->seats >= 1){
                $slots = $slots;
            }
            else{
                $slots = [];
            }
        }
        else{
            $slots = [];
        }

        $barber->booking = count($occupied);
        $barber->occupied = count(array_keys($bookeds, $req->time));
        $barber->available = $barber->seats - count(array_keys($bookeds, $req->time));
        $barber->slots = $slots;
        return response()->json([
            'success' => true,
            'barber' => $barber,
        ], 200);
    }

}
