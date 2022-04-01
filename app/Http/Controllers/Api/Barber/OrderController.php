<?php

namespace App\Http\Controllers\Api\Barber;

use JWTAuth;
use App\Favourite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;
use App\Product;

class OrderController extends Controller
{
    
    public function store(Request $req)
    {
        $validate = Request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'postal_code' => 'required'
        ]);
        try{
            $carts = json_decode($req->cart);
            if(count($carts) > 0){
                $subtotal = 0;
                foreach($carts as $cart){
                    $product = Product::find($cart->product_id);
                    if($product){
                       $subtotal += $product->price * $cart->quantity;
                    }
                }
                $order = new Order;
                $order->user_id = JWTAuth::user()->id;
                $order->subtotal = $subtotal;
                $order->tax = 0;
                $order->grand_total = $subtotal;
                $order->first_name = $req->first_name;
                $order->last_name = $req->last_name;
                $order->mobile = $req->mobile;
                $order->address = $req->address;
                $order->country_id = $req->country;
                $order->city_id = $req->city;
                $order->status = 1;
                $order->postal_code = $req->postal_code;
                if($order->save()){
                    foreach($carts as $cart){
                        $product = Product::find($cart->product_id);
                        if($product){
                            $order_item = new OrderItem;
                            $order_item->order_id = $order->id;
                            $order_item->p_id = $product->id;
                            $order_item->price = $product->price;
                            $order_item->qty = $cart->quantity;
                            $order_item->total = $product->price * $cart->quantity;
                            $order_item->save();
                        }
                        else{
                        return response()->json(['success'=>false,'message'=>'product not found'],404);
                        }
                    }
                    return response()->json([
                        'success' => true,
                        'message' => 'order placed successfully.',
                    ],200);
                }
            }
            else{
                return response()->json(['success'=>false,'message'=>'empty cart'],404);
            }
            }
            catch(\Exception $e){
                return response()->json(['success'=>false,'data'=>$e],400);
        }
    }

}
