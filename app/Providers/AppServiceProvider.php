<?php

namespace App\Providers;

use App\User;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            
            if(Auth::user()){
            $orders_count = Order::whereHas('orderItems.product', function ($query) {
                $query->where('user_id', '=', Auth::user()->id);
            })->whereHas('orderItems', function ($query) {
                $query->where('is_seen', '0');
            })->count();
            $seller = User::with('roles')->where('status','0')->whereHas('roles',function($q){
                $q->where('name','seller');
            })->count();
            $view->with(['v_order_count'=> $orders_count,'v_seller_count'=>$seller]);
            }
            
        });
    }
}
