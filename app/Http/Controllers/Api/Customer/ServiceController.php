<?php

namespace App\Http\Controllers\Api\Customer;

use App\User;
use App\Mail\OTP;
use Carbon\Carbon;
use App\Otp as AppOtp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Support\Facades\Mail;
use JWTAuth;

class ServiceController extends Controller
{
    public function barber()
    {
        $barbers = User::whereHas('roles', function ($q) {
            $q->where('name', 'barber');
        })->get()->makeHidden(['email','email_verified_at']);

        return response()->json([
            'success' => true,
            'barbers' => $barbers,
        ], 200);
    }
    public function showBarber($id)
    {
        $barber = User::whereHas('roles', function ($q) {
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

    public function showBarberService($id)
    {
        $services = Service::where('user_id', $id)->get();
            return response()->json([
                'success' => true,
                'services' => $services,
            ], 200);
    }
}
