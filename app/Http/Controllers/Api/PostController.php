<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Like;
use App\Post;
use JWTAuth;


class PostController extends Controller
{
    public function index(Request $req)
    {
        $social_forums = Post::withCount('like')->with('postComments.user:id,img,name')->with('user:id,img')->where('status','1')->get();
        return response()->json([
            'success' => true,
            'social_forums' => $social_forums,
        ], 200);
    }

    public function show($id)
    {
        $social_forum = Post::with('user:id,name,img','topicComments.user:id,img,name')->where('status','1')->where('id',$id)->first();
        if ($social_forum) {
            return response()->json([
                'success' => true,
                'social_forum' => $social_forum,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'not found',
            ], 404);
        }
    }

    public function store(Request $req)
    {
        $validate = Request()->validate([
            'title' => 'required',
            'description' => 'required|string',
        ]);
        try{
            $topic = new Post;
            $topic->user_id = JWTAuth::user()->id;
            $topic->title = $req->title;
            $topic->description = $req->description;
            $topic->status = $req->status;
            if($topic->save()){
                return response()->json([
                    'success' => true,
                    'message' => 'Topic successfully saved.',
                ],200);
            }
            }
            catch(\Exception $e){
                return response()->json(['success'=>false,'data'=>'something goes wrong'],400);
        }
    }

    public function like(Request $req,$id)
    {
        $like = Like::where('user_id',JWTAuth::user()->id)->where('id',$id)->first();
        if($like){
            $like->delete();
            return response()->json([
                'success' => true,
                'message' => 'Like successfully remove.',
            ],200);
        }
        else{
            try{
                $like = new Like;
                $like->user_id = JWTAuth::user()->id;
                $like->post_id = $id;
                $like->like = 1;
                if($like->save()){
                    return response()->json([
                        'success' => true,
                        'message' => 'Like successfully saved.',
                    ],200);
                }
                }
                catch(\Exception $e){
                    return response()->json(['success'=>false,'data'=>'something goes wrong'],400);
            }
        }
    }
}
