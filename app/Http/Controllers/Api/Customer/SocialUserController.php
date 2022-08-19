<?php

namespace App\Http\Controllers\Api\Customer;

use JWTAuth;
use App\Like;
use App\Post;
use App\Media;
use App\Friend;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;

class SocialUserController extends Controller
{

    public function getUsers()
    {
        $user_id=JWTAuth::user()->id;
        $friendsid=DB::select('SELECT GROUP_CONCAT(friends.friendship_id) AS friendship_id FROM friendships INNER JOIN friends ON friends.friendship_id=friendships.id WHERE friends.user_id='.$user_id);
        // $data = Friend::with('user')->whereIn('friendship_id',array($friendsid[0]->friendship_id))->get();

        $data1 = User::select('users.*','friends.request_type','friends.created_at','friends.updated_at','friends.friendship_id')->where('users.id','!=',$user_id)->join('friends','users.id','=','friends.user_id')
        ->whereIn('friends.friendship_id',explode(",",$friendsid[0]->friendship_id))
        ->get();
   
        $data2 = User::where('id','!=',$user_id)->whereHas('roles',function($q){
            $q->where('name','user');
        })->get();

       
        $result = $data2->merge($data1);

        return response()->json([
            'success' => true,
            'users' => $data1,
        ], 200);
    }
    public function getUsersById($id)
    {
        $user_id=JWTAuth::user()->id;
        $friendsid=DB::select('SELECT GROUP_CONCAT(friends.friendship_id) AS friendship_id FROM friendships INNER JOIN friends ON friends.friendship_id=friendships.id WHERE friends.user_id='.$user_id);
        $data1 = User::select('users.*','friends.request_type','friends.created_at','friends.updated_at','friends.friendship_id')->where('users.id','=',$id)->join('friends','users.id','=','friends.user_id')
        ->whereIn('friends.friendship_id',explode(",",$friendsid[0]->friendship_id))
        ->get();
        if(count($data1) >= 1){
            $data = $data1;
        }
        else{
        $data = User::where('id','=',$id)->whereHas('roles',function($q){
            $q->where('name','user');
        })->get();

        }
        return response()->json([
            'success' => true,
            'Users' => $data,
        ], 200);
    }

}
