<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use JWTAuth;
class User extends Authenticatable implements MustVerifyEmail , JWTSubject
{
    use Notifiable,HasRoles,SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','img','phone','operational_hours','location', 'password',
    ];

    protected $appends = ['full_image'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    function workingdays()
    {
        return $this->hasMany(WorkingDay::class, 'user_id', 'id');
    }

    function favourite()
    {
        return $this->hasOne(Favourite::class, 'favourite_against', 'id')->where('user_id',JWTAuth::user()->id);
    }
    
    function friends()
    {
        return $this->hasOne(Friend::class, 'user_id','id');
    }

    public function getFullImageAttribute(){

        if($this->img){

            return url('/').'/public/assets/images/user/'.$this->img;
        }
        else{
            return null;
        }

    }
    
}
