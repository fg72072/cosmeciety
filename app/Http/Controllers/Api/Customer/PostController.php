<?php

namespace App\Http\Controllers\Api\Customer;

use App\Comment;
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
        $posts = Post::withCount('like')->with('postcomments.user:id,img,name')->where('status','1')->get();
        return response()->json([
            'success' => true,
            'posts' => $posts,
        ], 200);
    }

    public function show($id)
    {
        $post = Post::withCount('like')->with('postcomments.user:id,img,name')->where('status','1')->where('id',$id)->first();
        if ($post) {
            return response()->json([
                'success' => true,
                'post' => $post,
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
            $post = new Post;
            $post->user_id = JWTAuth::user()->id;
            $post->title = $req->title;
            $post->description = $req->description;
            $post->status = $req->status;
            if($post->save()){
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
        $like = Like::where('user_id',JWTAuth::user()->id)->where('post_id',$id)->first();
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
