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
use App\Http\Controllers\Controller;
use App\Message;

class ChatController extends Controller
{
    
    public function index(Request $req)
    {
        $posts = Post::withCount('like')->with('postcomments.user:id,img,name','medias')->where('status','1')->get();
        return response()->json([
            'success' => true,
            'posts' => $posts,
        ], 200);
    }

    public function show($id)
    {
        $chats = Message::where('friendship_id',$id)->get();
            return response()->json([
                'success' => true,
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
