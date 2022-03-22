<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use Illuminate\Support\Facades\Auth;

class WallController extends Controller
{
    protected $media;

    public function __construct(CommonContainer $media){
        return $this->media = $media;
    }
    
    public function index()
    {
        $walls = Post::get();      
        return view('walls.list',compact('walls'));
    }

    public function create()
    {
        return view('walls.add');
    }

    public function store(Request $req)
    {
        $validate = Request()->validate([
            'title' => 'required',
            'description' => 'required|string',
        ]);
        $wall = new Post;
        $wall->user_id = Auth::user()->id;
        $wall->title = $req->title;
        $wall->description = $req->description;
        $wall->status = $req->status;
        $wall->save();
        return back();
    }

    public function edit($id)
    {
        $wall = Post::where('id',$id)->first();
        return view('walls.edit',compact('wall'));
    }

    public function update($id,Request $req)
    {
        $validate = Request()->validate([
            'title' => 'required',
            'description' => 'required|string',
        ]);
        $wall = Post::where('id',$id)->first();
        $wall->title = $req->title;
        $wall->description = $req->description;
        $wall->status = $req->status;
        $wall->save();
        return back();
    }

    public function destroy($id)
    {
        $wall = Post::where('id',$id);
        $wall->delete();
        return back();
    }
}
