<?php

namespace App\Http\Controllers\Api\Barber;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Service;
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
        $store->products = $product = Product::where('user_id', $id)->get();
        if ($product) {
            return response()->json([
                'success' => true,
                'store' => $store,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'not found',
            ], 404);
        }
    }

}
