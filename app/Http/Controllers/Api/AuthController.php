<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\User;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Otp as AppOtp;
use App\WorkingDay;

class AuthController extends Controller
{

    protected $media;
    public $loginAfterSignUp = true;

    public function __construct(CommonContainer $media){
        return $this->media = $media;
    }
        /**
     * @var bool
     */

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forMe(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }
    public function login(Request $request)
    {
        $validate = Request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email',$request->email)->first();
        if($user){
            if (Hash::check($request->password, $user->password)) {
                $request->user = $request->email;
                return OtpController::send($request,'not');
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Email or Password',
                ], 401);
            }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $req)
    {
        $validate = Request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:8|confirmed',
            'location' => 'location',
            'role' => 'required',
        ]);
       
        try{
            $user = new User;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->phone = $req->phone;
            $user->location = $req->location;
            $user->password = Hash::make($req->password);
            $user->status = '1';
            if ($req->hasFile('avatar')) {
                $image = $req->file('avatar');
                $name  = $this->media->getFileName($image);
                $path  = $this->media->getProfilePicPath('user');
                $image->move($path, $name);
                $user->img = $name;
            }
            if($user->save()){
                if($req->role == 'barber'){
                    $user->assignRole('barber');
                    for($i = 1;$i < 8;$i++){
                        $working_day = new WorkingDay;
                        $working_day->user_id = $user->id;
                        $working_day->day_id = $i;
                        $working_day->status = '0';
                        $working_day->save();
                    }
                }
                else{
                    $user->assignRole('user');
                }
                $req->user = $req->email;
                return OtpController::send($req,'not');
            }
            }
            catch(\Exception $e){
                return response()->json(['success'=>false,'data'=>'something goes wrong'],400);
        }
    }

    public function reset(Request $req)
    {
        $validate = Request()->validate([
            'user' => 'required',
            'otp' => 'required',
        ]);
        $otp = AppOtp::orderBy('id','desc')->with('user')->whereHas('user',function($q) use($req){
            $q->where('email',$req->user)->orWhere('phone',$req->user);
        })->where('otp',$req->otp)->where('verify','0')->first();

        $token = '';
        if($otp){
            $validate = Request()->validate([
                'password' => 'required|min:8|confirmed',
            ]);
            $otp->user->password = Hash::make($req->password);
            $otp->user->save();
            if (!$token = JWTAuth::fromUser($otp->user)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email or password',
                ], 401);
            }
            else{
                $otp->verify = '1';
                $otp->save();
                return response()->json([
                    'success' => true,
                    'token' => $token,
                ]);
            }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid Otp or Expire',
            ], 401);
        }
    }
    
}
