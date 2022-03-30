<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JWTAuth;

class Comment extends Model
{
    use SoftDeletes;
    // 0 = topic
    // 1 = post
    // 2 = contest
    protected $appends = ['childs'];

    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getChildsAttribute(){
        return $this->hasMany(Comment::class, 'parent', 'id')->where('status','1')->where('type','1')->with('user:id,name,img')->get();
    }
    public static function store($post_id,$message,$parent,$type){
        $comment = new Comment;
        $comment->post_id = $post_id;
        $comment->user_id = JWTAuth::user()->id;
        $comment->message = $message;
        $comment->parent = $parent;
        $comment->status = '1';
        $comment->type = $type;
        return $comment->save();
    }
}
