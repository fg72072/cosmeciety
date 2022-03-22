<?php

namespace App\Http\Controllers;

use App\Comment;
use App\SocialForum;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    protected $media;

    public function __construct(CommonContainer $media){
        return $this->media = $media;
    }
    
    public function index()
    {
        $topics = SocialForum::get();      
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
        $topic = new SocialForum;
        $topic->user_id = Auth::user()->id;
        $topic->title = $req->title;
        $topic->description = $req->description;
        $topic->status = $req->status;
        $topic->save();
        return back();
    }

    public function edit($id)
    {
        $topic = SocialForum::where('id',$id)->first();
        return view('topics.edit',compact('topic'));
    }

    public function update($id,Request $req)
    {
        $validate = Request()->validate([
            'title' => 'required',
            'description' => 'required|string',
        ]);
        $topic = SocialForum::where('id',$id)->first();
        $topic->title = $req->title;
        $topic->description = $req->description;
        $topic->status = $req->status;
        $topic->save();
        return back();
    }

    public function destroy($id)
    {
        $topic = SocialForum::where('id',$id);
        $topic->delete();
        return back();
    }
}
