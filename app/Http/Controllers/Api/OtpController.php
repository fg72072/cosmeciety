<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Mail\OTP;
use Carbon\Carbon;
use App\Otp as AppOtp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use JWTAuth;

class OtpController extends Controller
{
    public static function send(Request $req,$field = ''){
        if($field){
        }
        else{
            $validate = Request()->validate([
                'user' => 'required',
            ]);
        }
        $otp_value = '';
        $user = User::where('email',$req->user)->orWhere('phone',$req->user)->pluck('id')->first();
        if($user){
        $otp_value =str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        if($req->type == 'phone'){
        }
        else{
            Mail::to($req->user)->send(new OTP($otp_value));
        }
        $otp = AppOtp::with('user')->whereHas('user',function($q) use($req){
            $q->where('email',$req->user)->orWhere('phone',$req->user);
        })->first();
        if(!$otp){
            $otp = new AppOtp;
            $otp->user_id = $user;
        }
        $otp->otp = $otp_value;
        $otp->verify = '0';
        $otp->expire = Carbon::now();
        $otp->save();
        return response()->json(['success'=>true,'data'=>'otp has been sent succeesfully'],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }
    }
    public function otpVerify(Request $req)
    {
        $validate = Request()->validate([
            'user' => 'required',
            'otp' => 'required',
        ]);
        $otp = AppOtp::orderBy('id','desc')->with('user')->whereHas('user',function($q) use($req){
            $q->where('email',$req->user)->orWhere('phone',$req->user);
        })->where('otp',$req->otp)->where('verify','0')->first();
        $token = '';
        if($otp){
            if (!$token = JWTAuth::fromUser($otp->user)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email or password',
                ], 401);
            }
            else{
                $otp->verify = '1';
                $otp->save();
                return response()->json([
                    'success' => true,
                    'token' => $token,
                ]);
            }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid Otp or Expire',
            ], 401);
        }

    }
}
