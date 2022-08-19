<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    //
    // 1 = saloon
    // 2 = social wall
    // 3 = contest
    // 4  = Participant
    // 5  = Promotions
    // 6 products

    use SoftDeletes;
    public $table = 'medias';
    protected $appends = ['full_image'];

    public function getFullImageAttribute(){
        if($this->type == '2'){
            return url('/').'/public/assets/images/post/'.$this->file;
        }
        if($this->type == '3'){
            return url('/').'/public/assets/images/contest/'.$this->file;
        }
        if($this->type == '4'){
            return url('/').'/public/assets/images/media/'.$this->file;
        }
        if($this->type == '5'){
            return url('/').'/public/assets/images/promotions/'.$this->file;
        }
        if($this->type == '6'){
            return url('/').'/public/assets/images/product/'.$this->file;
        }
    }
}
