<?php

namespace App\Http\Controllers;

use App\Contest;
use App\User;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){
        $data['order'] = Order::with('orderItems.product')->whereHas('orderItems.product', function ($query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->count();
        $data['product'] = Product::where('user_id',Auth::user()->id)->count();
        $data['user'] = User::count();
        $data['contest'] = Contest::count();
        return view('index',$data);
    }
}
