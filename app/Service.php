<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    //

    protected $appends = ['full_image'];

    function barber()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getFullImageAttribute(){

        if($this->picture){

            return url('/').'/public/assets/images/service/'.$this->picture;
        }
        else{
            return null;
        }

    }
}
