<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $media;

    public function __construct(CommonContainer $media){
        return $this->media = $media;
    }

    public function index()
    {
        $data['users'] = User::with('roles')->whereHas('roles',function($q){
            $q->where('name','user');
        })->get();
        $data['type'] = 'User';
        return view('user.list',$data);
    }
    public function barber()
    {
        $data['users'] = User::with('roles')->whereHas('roles',function($q){
            $q->where('name','barber');
        })->get();
        $data['type'] = 'Barber';

        return view('user.list',$data);
    }
    public function seller()
    {
        $data['users'] = User::with('roles')->whereHas('roles',function($q){
            $q->where('name','seller');
        })->get();
        $data['type'] = 'Seller';

        return view('user.list',$data);
    }

    public function create()
    {
        $roles = Role::all()->pluck('name');
        return view('user.add',compact('roles'));
    }

    public function store(Request $req)
    {
        $validate = Request()->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required',
        ]);

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->phone = $req->phone;
        $user->operational_hours = $req->operational_hours;
        $user->location = $req->location;
        $user->password = Hash::make($req->password);
        $user->status = $req->status;
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('user');
            $image->move($path, $name);
            $user->img = $name;
        }
        $user->save();
        $user->assignRole($req->role);
        return back();
    }

    public function edit($id)
    {
        $role = Auth::user()->roles->pluck('name');
        if($role[0] != 'super-admin' && Auth::user()->id != $id){
            return abort(403,'User does not have the right roles.');
        }
        $user = User::find(Auth::user()->id);
        return view('user.edit',compact('user'));
    }

    public function update($id,Request $req)
    {
        $email_validate = "required";
        $user = User::find(Auth::user()->id);
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $this->media->unlinkProfilePic($user->img,'user');
            $name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('user');
            $image->move($path, $name);
            $user->img = $name;
        }
        if(Auth::user()->id == $id){
        if(Auth::user()->email != $req->email){

            $email_validate = "required|max:255|email|unique:users";
        }
        else{
            $email_validate = "required|max:255";
        }
        if(!$req->change_pass){
            $validate = Request()->validate([
                'name'=>'required|max:255',
                'email'=>$email_validate,
                'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:20',
            ]);
            Auth::user()->update([
                'name'=>$req->name,
                'email'=>$req->email,
                'phone'=>$req->phone,
                'operational_hours'=>$req->operational_hours,
                'location'=>$req->location,
            ]);
        }
        
        if($req->change_pass){
            if (Hash::check($req->current_password, Auth::user()->password)) {
                $validate = Request()->validate([
                    'current_password' => 'required|min:8|max:20',
                    'password' => 'required|min:8|max:20|confirmed'
                ]);
                Auth::user()->update([
                    'password'=> Hash::make($req->password),
                ]);
                return redirect()->back()->with(['msg_success'=>'Your password has been changed','success'=>'Your password has been changed']);
            } else {
                return redirect()->back()->with(['error'=>'The provided password does not match your current password.']);
            }
        }
        }
        else{
            $role = Auth::user()->roles->pluck('name');
            if($role[0] == 'super-admin'){
            $email_validate = "required";
            if($user->email != $req->email){
                $email_validate = "required|max:255|email|unique:users";
            }
            $validate = Request()->validate([
                'email'=>$email_validate,
                'name'=>'required|max:255',
                'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:20',
                'status'=>'required',
            ]);
            $user->name = $req->name;
            $user->email = $req->email;
            $user->phone = $req->phone;
            $user->operational_hours = $req->operational_hours;
            $user->location = $req->location;
            $user->status = $req->status;
            }
        }        
        $user->save();
        return back()->with(['msg_success'=>'Profile has been updated.']);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back();
    }
    public function updateStatus($id,Request $req){
        $user = User::find($id);
        $user->status = $req->status;
        $user->save();
        return back();
    }
}
