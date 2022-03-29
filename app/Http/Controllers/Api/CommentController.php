<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use Carbon\Carbon;
use App\SocialForum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;


class CommentController extends Controller
{
    public function storeTopicComment(Request $req,$id)
    {
        $validate = Request()->validate([
            'message' => 'required',
        ]);
        try{
            if(Comment::store($id,$req->message,0,'0')){
                return response()->json([
                    'success' => true,
                    'message' => 'Comment successfully saved.',
                ],200);
            }
            }
            catch(\Exception $e){
                return response()->json(['success'=>false,'message'=>$e],400);
        }
    }
}
