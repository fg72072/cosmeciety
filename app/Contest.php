<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JWTAuth;

class Contest extends Model
{
    use SoftDeletes;
    //
     protected $appends = ['full_image'];
    function participants()
    {
        return $this->hasMany(Participant::class, 'contest_id', 'id');
    }

    function participant()
    {
        return $this->hasOne(Participant::class, 'contest_id', 'id');
    }

    function isparticipant()
    {
        return $this->hasOne(Participant::class, 'contest_id', 'id')->where('user_id',JWTAuth::user()->id);
    }
    
        public function getFullImageAttribute(){

        if($this->banner){

            return url('/').'/public/assets/images/contest/'.$this->banner;
        }
        else{
            return null;
        }

    }

}
