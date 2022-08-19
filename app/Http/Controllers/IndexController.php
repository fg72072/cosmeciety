<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Contest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){
        // order count 
        $data['order'] = Order::with('orderItems.product')->whereHas('orderItems.product', function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->count();
        // product count 
        $data['product'] = Product::where('user_id',Auth::user()->id)->count();
        // user count 
        $data['user'] = User::whereHas('roles',function($q){
            $q->where('name','user');
        })->count();
        // barber count 
        $data['barber'] = User::whereHas('roles',function($q){
            $q->where('name','barber');
        })->count();
        // seller count 
        $data['seller'] = User::whereHas('roles',function($q){
            $q->where('name','seller');
        })->count();
        // contest count 
        $data['contest'] = Contest::count();
        // upcoming contest count 
        $data['upcoming_contest'] = Contest::where('contest_live_date','>=',now()->format('Y/m/d H:i'))->count();
        // total sales 
        // $total_sales = Order::with('orderItems')
        // ->whereHas('orderItems.product', function ($query) {
        //     $query->where('user_id', '=', Auth::user()->id);
        // })->get();

        $data['total_sales'] =Order::whereHas('orderItems.product', function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->join('order_items', 'order_items.order_id', '=', 'orders.id')
        ->get(['orders.id', DB::raw('sum(order_items.total) as total')])
        ->sum('total');

        $data['top_product'] = Order::withCount('orderItems')->whereHas('orderItems.product', function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->orderBy('order_items_count', 'desc')->take(5)->count();

        $data['pending_order'] = Order::whereHas('orderItems.product', function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->whereHas('orderItems.deliveryStatus',function($query){
            $query->where('status', '=', '1');
        })->count();

        return view('index',$data);
    }
}
