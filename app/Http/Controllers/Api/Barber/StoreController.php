<?php

namespace App\Http\Controllers\Api\Barber;

use JWTAuth;
use App\User;
use App\Order;
use App\Product;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function store(Request $req)
    {
        $stores = User::with('favourite')->where('name', 'like', '%' . $req->title . '%')->whereHas('roles', function ($q) {
            $q->where('name', 'seller')->where('status','1');
        })->get()->makeHidden(['operational_hours','email','email_verified_at']);

        return response()->json([
            'success' => true,
            'stores' => $stores,
        ], 200);
    }
    public function showStore(Request $req,$id)
    {
        $store = User::with('favourite')->whereHas('roles', function ($q) {
            $q->where('name', 'seller')->where('status','1');
        })->where('id',$id)->first()->makeHidden(['email','email_verified_at']);
        
        $product = Product::with('favourite')->with('media')->where('user_id', $id);
        if($req->sort_type == 'high'){
            $product = $product->orderBy('price','desc');
        }
        if($req->sort_type == 'low'){
            $product = $product->orderBy('price','asc');
        }
        $product = $product->get();
        $store->products = $product;
        foreach($store->products as $prod){
            $prod->stock = Product::stock($prod->id);
        } 
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
    public function product(Request $req)
    {
        $products = Product::with('favourite')->where('title', 'like', '%' . $req->title . '%')->with('seller:id,name','media')->where('status','1')->get();
        foreach($products as $prod){
            $prod->stock = Product::stock($prod->id);
        } 
        return response()->json([
            'success' => true,
            'products' => $products,
        ], 200);
    }

    public function popularProduct()
    {
        $popular_products = Product::withCount('orderitems')->with('favourite')->where('title', 'like', '%' . $req->title . '%')
        ->with('seller:id,name','media')->where('status','1')
        ->orderBy('orderitems_count', 'desc')->take(5)->get();

        foreach($popular_products as $prod){
            $prod->stock = Product::stock($prod->id);
        }
        
        return response()->json([
            'success' => true,
            'popular_products' => $popular_products,
        ], 200);
    }

}
