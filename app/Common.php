<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Common extends Model
{
    public static function userRole()
    {
       return Auth::user()->roles->pluck('name');
    }
    
}
