<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $media;

    public function __construct(CommonContainer $media){
        return $this->media = $media;
    }
    
    public function index()
    {
        $topics = Post::where('type','1')->get();      
        return view('topics.list',compact('topics'));
    }

    public function create()
    {
        return view('topics.add');
    }

    public function store(Request $req)
    {
        $validate = Request()->validate([
            'title' => 'required',
            'description' => 'required|string',
        ]);
        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->title = $req->title;
        $post->description = $req->description;
        $post->type = '1';
        $post->status = $req->status;
        $post->save();
        return back();
    }

    public function edit($id)
    {
        $topic = Post::where('type','1')->where('id',$id)->first();
        return view('topics.edit',compact('topic'));
    }

    public function update($id,Request $req)
    {
        $validate = Request()->validate([
            'title' => 'required',
            'description' => 'required|string',
        ]);
        $topic = Post::where('type','1')->where('id',$id)->first();
        $topic->title = $req->title;
        $topic->description = $req->description;
        $topic->status = $req->status;
        $topic->save();
        return back();
    }

    public function destroy($id)
    {
        $post = Post::where('id',$id);
        $post->delete();
        return back();
    }
}
