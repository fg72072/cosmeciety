<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\User;
use App\Media;
use Exception;
use App\WorkingDay;
use App\Notification;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    protected $media;

    public function __construct(CommonContainer $media)
    {
        return $this->media = $media;
    }

    public function update(Request $request)
    {
        try {
            $data = JWTAuth::user();
            if (isset($request->name)) {
                $data->name = $request->name;
            }
            if (isset($request->email)) {
                $data->email = $request->email;
            }
            if (isset($request->phone)) {
                $data->phone = $request->phone;
            }
            if (isset($request->location)) {
                $data->location = $request->location;
            }
            if (isset($request->business_name)) {
                $data->business_name = $request->business_name;
            }
            if (isset($request->business_about)) {
                $data->business_about = $request->business_about;
            }
            if (isset($request->password)) {
                $data->password = Hash::make($request->password);
                Notification::notification(JWTAuth::user()->id,0,0,'Password Change','Your Password has been changed successfully','0');
            }

            if ($request->hasFile('img')) {
                $request->validate([
                    'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $image = $request->file('img');
                $name  = $this->media->getFileName($image);
                $path  = $this->media->getProfilePicPath('profile');
                $image->move($path, $name);

                $data->img = $name;
            }
            // $data->name = 'test';
            if ($data->save()) {
                return  response()->json([
                    'success' => true,
                    'message' => 'Profile Updated Successfully'
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }

    public function upload_media(Request $request)
    {
        try {
            //code...
            // if (count($request->img) > 5) {
                $data = JWTAuth::user();
                for ($i = 0; $i < count($request->file('img')); $i++) {
                    # code...
                    if ($request->hasFile('img')) {
                        $image = $request->file('img')[$i];
                        $name  = $this->media->getFileName($image);
                        $path  = $this->media->getProfilePicPath('media');
                        $image->move($path, $name);
                        $uploadmedia = new Media;
                        $uploadmedia->user_id = $data->id;
                        $uploadmedia->file = $name;
                        $uploadmedia->type = '1';
                        if($uploadmedia->save()){

                        }
                    }
                }
                return  response()->json([
                    'success' => true,
                    'message' => 'File Saved Successfully'
                ]);
            // }
            // else
            // {
            //     return  response()->json([
            //         'success' => false,
            //         'message' => 'At a time four images uploaded'
            //     ]);
            // }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }

    public function updateWorkingDays(Request $req,$id)
    {
        try {
            $working_day = WorkingDay::where('user_id',JWTAuth::user()->id)->where('day_id',$id)->first();
            if($req->open){
                $working_day->open = $req->open;
            }
            if($req->close){
                $working_day->close = $req->close;
            }
            $working_day->status = $req->status;
            if ($working_day->save()) {
                return  response()->json([
                    'success' => true,
                    'message' => 'Working Day Updated Successfully'
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }
}
