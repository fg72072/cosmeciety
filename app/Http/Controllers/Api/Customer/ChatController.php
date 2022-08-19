<?php

namespace App\Http\Controllers\Api\Customer;

use JWTAuth;
use App\User;
use App\Post;
use App\Media;
use App\Friend;
use App\Comment;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use Illuminate\Support\Facades\DB;
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

    public function getChatUser()
    {
        // $users = DB::select('SELECT users.id as user_id,users.name,users.img,messages.id,messages.friendship_id,messages.user_id as sender_id,messages.body,messages.is_seen,(SELECT COUNT(*)FROM messages WHERE friends.user_id!='.JWTAuth::user()->id.' AND is_seen IS NULL) AS total_unread,messages.created_at,friends.user_id FROM `messages` INNER JOIN friendships ON friendships.id=messages.friendship_id INNER JOIN friends ON friends.friendship_id=friendships.id INNER JOIN users ON users.id=friends.user_id WHERE friends.user_id!='.JWTAuth::user()->id.' GROUP BY messages.friendship_id ORDER BY messages.created_at DESC');
        $user_id=JWTAuth::user()->id;
        $friendsid=DB::select('SELECT GROUP_CONCAT(friends.friendship_id) AS friendship_id FROM friendships INNER JOIN friends ON friends.friendship_id=friendships.id WHERE friends.user_id='.$user_id);
        $users = User::select('users.*','friends.request_type','friends.created_at','friends.updated_at','friends.friendship_id')->where('users.id','!=',$user_id)->join('friends','users.id','=','friends.user_id')
        ->whereIn('friends.friendship_id',explode(",",$friendsid[0]->friendship_id))
        ->get();
        foreach($users as $user){
            $user->unread_total = Message::where([['friendship_id',$user->friendship_id],['user_id','!=',$user_id],['is_seen','=',null]])->orderBy('created_at','desc')->count();
            $user->message = Message::where('friendship_id',$user->friendship_id)->orderBy('created_at','desc')->first();
        }
        return response()->json([
            'success' => true,
            'users' => $users,
        ],200);
    }
}
