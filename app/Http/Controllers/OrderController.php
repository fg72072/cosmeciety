<?php

namespace App\Http\Controllers;

use App\City;
use App\Order;
use App\Country;
use App\DeliveryStatus;
use App\OrderItem;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $req){
        $orders = Order::with('user','country:id,name','city:id,name')
        ->whereHas('orderItems.product', function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->whereHas('orderItems.deliveryStatus',function($q){
            $q->where('title','!=','Cancel');
        });
        
        if($req->type == 'pending'){
            $orders = $orders->whereHas('orderItems.deliveryStatus',function($q){
                $q->where('title','Pending');
            });
        }
        $orders = $orders->get();
        foreach($orders as $order){
            $order->orderItems = OrderItem::with('deliveryStatus')->where('order_id',$order->id)->whereHas('product',function($q){
               $q->where('user_id', '=', Auth::user()->id);
            })->get();
            foreach($order->orderItems as $item){
                $order_item_p = Product::where([['user_id',Auth::user()->id],['id',$item->p_id]])->get();
                $item->product = $order_item_p;
            }
        }
        
        return view('orders.list',compact('orders'));
    }

    public function edit($id)
    {
        // get order 
        $data['order'] = Order::whereHas('orderItems.product', function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->where('id',$id)->first();
        // get order items 
        $data['order']->orderItems = OrderItem::with('deliveryStatus')->where('order_id',$id)->whereHas('product',function($q){
            $q->where('user_id', '=', Auth::user()->id);
        })->get();
        // get order product 
        foreach($data['order']->orderItems as $item){
            $order_item_p = Product::with('media')->where([['user_id',Auth::user()->id],['id',$item->p_id]])->first();
            $item->product = $order_item_p;
        }
        $data['order']->orderItems()->update(['is_seen' => '1']);
        $data['statuses'] = DeliveryStatus::get();
        $data['cities'] = City::limit(10)->get();
        $data['countries'] = Country::get();
        return view('orders.edit',$data);
    }

    public function update($id,Request $req)
    {
        // $validate = Request()->validate([
        //     'message' => 'required|string',
        // ]);
        // $order = Order::whereHas('orderItems.product', function ($query) {
        //     $query->where('user_id', '=', Auth::user()->id);
        // })->where('id',$id)->first();
        $order = OrderItem::where('order_id',$id)->whereHas('product',function($q){
            $q->where('user_id',Auth::user()->id);
        })->update(['status'=>$req->status]);
        // $order->first_name = $req->first_name;
        // $order->last_name = $req->last_name;
        // $order->mobile = $req->mobile;
        // $order->postal_code = $req->postal_code;
        // $order->country_id = $req->country;
        // $order->city_id = $req->city;
        // $order->status = $req->status;
        // $order->save();
        return back();
    }
}
