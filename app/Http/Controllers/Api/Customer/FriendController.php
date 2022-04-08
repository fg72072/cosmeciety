<?php

namespace App\Http\Controllers\Api\Customer;

use JWTAuth;
use App\Like;
use App\Post;
use App\Media;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use App\Friend;
use App\Friendship;
use App\Http\Controllers\Controller;
use App\Message;

class FriendController extends Controller
{
    public function store(Request $req,$id)
    {
        try{
            $friendship = new Friendship;
            $friendship->creater_id = JWTAuth::user()->id;
            if($friendship->save()){
                Friend::store($friendship->id,JWTAuth::user()->id,1);
                Friend::store($friendship->id,$id,0);
                return response()->json([
                    'success' => true,
                    'message' => 'Request send successfully.',
                ],200);
            }
            }
            catch(\Exception $e){
                return response()->json(['success'=>false,'data'=>'something goes wrong'],400);
        }
    }

    public function accept(Request $req,$id)
    {
        
    }

    public function reject(Request $req,$id)
    {

    }
}
