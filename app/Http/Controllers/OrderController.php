<?php

namespace App\Http\Controllers;

use App\City;
use App\Order;
use App\Country;
use App\DeliveryStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        // $orders = Order::whereHas('orderItems.product', function ($query) {
        //     $query->where('user_id', '=', Auth::user()->id);
        // })->get();

        $orders = Order::with('user','deliveryStatus')->whereHas('orderItems.product', function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->get();

        return view('orders.list',compact('orders'));
    }

    public function edit($id)
    {
        $data['order'] = Order::with('orderItems.product')->whereHas('orderItems.product', function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->where('id',$id)->first();
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
        $order = Order::whereHas('orderItems.product', function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->where('id',$id)->first();
        $order->first_name = $req->first_name;
        $order->last_name = $req->last_name;
        $order->mobile = $req->mobile;
        $order->postal_code = $req->postal_code;
        $order->country_id = $req->country;
        $order->city_id = $req->city;
        $order->status = $req->status;
        $order->save();
        return back();
    }
}
