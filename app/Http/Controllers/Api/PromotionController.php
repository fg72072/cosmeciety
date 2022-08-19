<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Media;
use Exception;
use App\Comment;
use App\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    protected $media;

    public function __construct(CommonContainer $media)
    {
        return $this->media = $media;
    }

    public function getAllPromotion(Request $request)
    {
        try {
            $data = JWTAuth::user();
            $date = now()->format('d/m/Y');
            // ->where('start_date','>=',$date)
            // ->where('end_date','>=',$date)
            $promotion = Promotion::with('user','medias')->where('start_date','>=',$date)->orderBy('id','desc')->get();
            return  response()->json([
                'success' => true,
                'data' => $promotion,
            ]);

        } catch (\Exception $ex) {
            //throw $th;
            return response()->json(['success' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }

    public function addPromotion(Request $request)
    {
        // return now()->format('d/m/Y');
        $validate = Request()->validate([
            'img' => 'required',
            'img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1000',
            'name' => 'required|max:255',
            'description' => 'required|string|max:500',
            'date' => 'required|date_format:d/m/Y|after_or_equal:'.now()->format('d/m/Y'),
            'duration' => 'required|integer|min:1|max:4',
        ]);

        try {
            $start_date = Carbon::createFromFormat('d/m/Y', $request->date);
            $data = JWTAuth::user();
            $promotion = new Promotion();
            $promotion->user_id = $data->id;
            $promotion->name = $request->name;
            $promotion->description = $request->description;
            $promotion->start_date = $start_date->format('d/m/Y');
            $promotion->end_date = $start_date->addWeeks($request->duration)->format('d/m/Y');
            $promotion->save();

            for ($i = 0; $i < count($request->file('img')); $i++) {
                # code...
                if ($request->hasFile('img')) {
                    $image = $request->file('img')[$i];
                    $name  = $this->media->getFileName($image);
                    $path  = $this->media->getProfilePicPath('promotions');
                    $image->move($path, $name);
                    $uploadmedia = new Media();
                    $uploadmedia->user_id = $data->id;
                    $uploadmedia->file = $name;
                    $uploadmedia->type = '5';
                    $uploadmedia->media_against = $promotion->id;
                    if ($uploadmedia->save()) {
                    }
                }
            }
            return  response()->json([
                'success' => true,
                'message' => 'Promotion saved successfully'
            ]);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }
    public function getPromotion(Request $request)
    {
        try {
            $data = JWTAuth::user();
            $promotion = Promotion::with('user','medias')->where('user_id',JWTAuth::user()->id)->get();
            return  response()->json([
                'success' => true,
                'data' => $promotion,
            ]);

        } catch (\Exception $ex) {
            //throw $th;
            return response()->json(['success' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }
    public function removePromotion($id)
    {
        try {
            $data = JWTAuth::user();
            $promotion = Promotion::where('user_id',JWTAuth::user()->id)->where('id',$id)->first();
            if($promotion){
                $promotion->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Promotion Remove Successfully.',
                ],200);
            }


        } catch (\Exception $ex) {
            //throw $th;
            return response()->json(['success' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }
}
