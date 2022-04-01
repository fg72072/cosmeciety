<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contest extends Model
{
    use SoftDeletes;
    //
    function participants()
    {
        return $this->hasMany(Participant::class, 'contest_id', 'id');
    }

    function participant()
    {
        return $this->hasOne(Participant::class, 'contest_id', 'id');
    }

}
