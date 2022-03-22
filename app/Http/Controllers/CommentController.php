<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function edit($id)
    {
        $comment = Comment::where('id',$id)->first();
        return view('comments.edit',compact('comment'));
    }

    public function update($id,Request $req)
    {
        $validate = Request()->validate([
            'message' => 'required|string',
        ]);
        $comment = Comment::where('id',$id)->first();
        $comment->message = $req->message;
        $comment->status = $req->status;
        $comment->save();
        return back();
    }
}
