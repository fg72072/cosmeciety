<?php

namespace App\Http\Controllers\Api\Customer;

use JWTAuth;
use App\Favourite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FavouriteController extends Controller
{
    
    public function index(Request $req)
    {
        $favourites = Favourite::with('barber')->whereHas('barber',function($q){
            $q->where('status','1');
        })->get();
        return response()->json([
            'success' => true,
            'favourites' => $favourites,
        ], 200);
    }
    public function addToFavourite($id)
    {
        try{
            $fav = Favourite::where('user_id',JWTAuth::user()->id)->where('saloon_id',$id)->first();
            if($fav){
                $fav->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Saloon Remove Successfully.',
                ],200);
            }
            else{
                $favourite = new Favourite;
                $favourite->user_id = JWTAuth::user()->id;
                $favourite->saloon_id = $id;
                if($favourite->save()){
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
