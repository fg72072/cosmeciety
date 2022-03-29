<?php

namespace App\Http\Controllers\Api\Barber;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use JWTAuth;

class StoreController extends Controller
{
    public function store()
    {
        $stores = User::whereHas('roles', function ($q) {
            $q->where('name', 'seller');
        })->get()->makeHidden(['email','email_verified_at']);

        return response()->json([
            'success' => true,
            'stores' => $stores,
        ], 200);
    }
    public function showStore($id)
    {
        $store = User::whereHas('roles', function ($q) {
            $q->where('name', 'seller');
        })->where('id',$id)->first()->makeHidden(['email','email_verified_at']);
        
        $store->products = $barber = Product::where('user_id', $id)->get();
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
