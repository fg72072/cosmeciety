<?php

namespace App\Http\Controllers\Api\Customer;

use JWTAuth;
use App\Like;
use App\Post;
use App\Media;
use App\Friend;
use App\Comment;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ChatController extends Controller
{
    
    public function index(Request $req)
    {
        // return response()->json([
        //     'success' => true,
        //     'posts' => $posts,
        // ], 200);
    }

    public function show($id)
    {
        $friend = Friend::with('user:id,img,name,last_seen')->where('friendship_id',$id)->where('user_id','!=',JWTAuth::user()->id)->first(['user_id']);
        if(Cache::has('is_online' . $friend->user->id)){
                 $friend->user->lastseen = 'online';
        }
        unset($friend->user_id);
        $chats = Message::where('friendship_id',$id)->get();
            return response()->json([
                'success' => true,
                'friend' => $friend->user,
                'chats' => $chats,
            ], 200);
    }

    public function store(Request $req,$id)
    {
        $validate = Request()->validate([
            'body' => 'required|string',
        ]);
        try{
            $message = new Message;
            $message->friendship_id = $id;
            $message->user_id = JWTAuth::user()->id;
            $message->body = $req->body;
            $message->status = '0';
            if($message->save()){
                return response()->json([
                    'success' => true,
                    'message' => 'Message send successfully.',
                ],200);
            }
            }
            catch(\Exception $e){
                return response()->json(['success'=>false,'data'=>'something goes wrong'],400);
        }
    }
}
