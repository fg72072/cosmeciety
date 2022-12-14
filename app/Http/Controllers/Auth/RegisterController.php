<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Container\CommonContainer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    protected $media;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/login';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CommonContainer $media)
    {
        $this->middleware('guest');
        return $this->media = $media;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'avatar' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'phone' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:11','max:20'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed','max:20'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $name = '';
        if ($data['avatar']) {
            $image = $data['avatar'];
            $name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('user');
            $image->move($path, $name);
        }

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'img' => $name,
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole('seller');
        return $user;
    }
}
