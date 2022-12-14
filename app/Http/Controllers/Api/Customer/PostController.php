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


class PostController extends Controller
{
    protected $media;

    public function __construct(CommonContainer $media)
    {
        return $this->media = $media;
    }
    
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
        $post = Post::withCount('like')->with('postcomments.user:id,img,name','medias')->where('status','1')->where('id',$id)->first();
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
            'img' => 'required'
        ]);
        if(count($req->file('img')) > 4){
            return response()->json([
                'success' => false,
                'message' => 'Media must be less than 4 or equal.',
            ],200);
        }
        try{
            $post = new Post;
            $post->user_id = JWTAuth::user()->id;
            $post->title = $req->title;
            $post->description = $req->description;
            $post->status = '1';
            if($post->save()){
                for ($i = 0; $i < count($req->file('img')); $i++) {
                    # code...
                    if ($req->hasFile('img')) {
                        $image = $req->file('img')[$i];
                        $name  = $this->media->getFileName($image);
                        $path  = $this->media->getProfilePicPath('post');
                        $image->move($path, $name);
                        $uploadmedia = new Media;
                        $uploadmedia->user_id = JWTAuth::user()->id;
                        $uploadmedia->media_against = $post->id;
                        $uploadmedia->file = $name;
                        $uploadmedia->type = '2';
                        if($uploadmedia->save()){

                        }
                    }
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Post successfully saved.',
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
