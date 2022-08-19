<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\SocialForum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;


class CommunityController extends Controller
{
    public function index(Request $req)
    {
        $social_forums = SocialForum::withCount('topiccomments')->with('user:id,img','topiccomments.user:id,img,name')
        ->where('status','1');
        if($req->type == 'trending'){
            $social_forums = $social_forums->withCount('topiccomments')->orderBy('topiccomments_count','Desc');
        }
        else if($req->type == 'new'){
            $social_forums = $social_forums->orderBy('id','Desc');
        }
        else if($req->type == 'active'){
            $social_forums = $social_forums->where('status','1');
        }
        else{
            $social_forums = $social_forums->orderBy('id','Desc');
        }
        $social_forums = $social_forums->get();
        return response()->json([
            'success' => true,
            'social_forums' => $social_forums,
        ], 200);
    }

    public function show($id)
    {
        $social_forum = SocialForum::with('user:id,name,img','topiccomments.user:id,img,name')
        ->where('status','1')->where('id',$id)->first();
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
            $topic = new SocialForum;
            $topic->user_id = JWTAuth::user()->id;
            $topic->title = $req->title;
            $topic->description = $req->description;
            $topic->status = '1';
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
}
