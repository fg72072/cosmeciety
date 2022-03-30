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
    // 4 = participant

    use SoftDeletes;
    public $table = 'medias';
}
