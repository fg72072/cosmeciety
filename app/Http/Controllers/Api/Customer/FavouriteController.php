<?php

namespace App\Http\Controllers\Api\Customer;

use JWTAuth;
use App\Favourite;
use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
class FavouriteController extends Controller
{
    
    public function index(Request $req)
    {
        $favourites = "";
        if($req->type == "barber"){
            $favourites = Favourite::where('user_id',JWTAuth::user()->id)->with('barber')->whereHas('barber',function($q){
                $q->where('status','1');
            })->where('type','0')->get();
        }
        else if($req->type == "seller"){
            $favourites = Favourite::where('user_id',JWTAuth::user()->id)->with('seller')->whereHas('seller',function($q){
                $q->where('status','1');
            })->where('type','1')->get();
        }
        
        else {
            $favourites = Favourite::where('user_id',JWTAuth::user()->id)->with('product.media')->whereHas('product',function($q){
                $q->where('status','1');
            })->where('type','3')->get();
        }
        
        return response()->json([
            'success' => true,
            'favourites' => $favourites,
        ], 200);
    }
    public function addToFavourite(Request $req,$id)
    {
        try{
            $type = '0';
            $name = '';
            if($req->type == 'barber'){
                $type = '0';
                $name = User::where('id',$id)->whereHas('roles',function($q){
                    $q->where('name','barber');
                })->first()->name;
            }
            else if($req->type == 'seller'){
                $type = '1';
                $name = User::where('id',$id)->whereHas('roles',function($q){
                    $q->where('name','seller');
                })->first()->name;
            }
            else{
                $type = '3';
                $name = Product::where('id',$id)->first()->title;
            }
            $fav = Favourite::where('user_id',JWTAuth::user()->id)->where('favourite_against',$id)->where('type',$type)->first();
            if($fav){
                $fav->delete();
                Notification::notification(JWTAuth::user()->id,0,0,'Favourite','You have removed '.$name.' to your favorites','0');
                return response()->json([
                    'success' => true,
                    'message' => 'Remove Favourite Successfully.',
                ],200);
            }
            else{
                $favourite = new Favourite;
                $favourite->user_id = JWTAuth::user()->id;
                $favourite->favourite_against = $id;
            
                $favourite->type = $type;
                if($favourite->save()){
                    Notification::notification(JWTAuth::user()->id,0,0,'Favourite','You have added '.$name.' to your favorites','0');
                    return response()->json([
                        'success' => true,
                        'message' => 'Success.',
                    ],200);
                }
            }
            }
            catch(\Exception $e){
                return response()->json(['success'=>false,'data'=>'something goes wrong'],400);
        }
    }

}
