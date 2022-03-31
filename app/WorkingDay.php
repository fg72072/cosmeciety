<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    function day()
    {
        return $this->belongsTo(Day::class, 'day_id', 'id');
    }
}
