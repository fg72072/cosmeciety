<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use JWTAuth;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use App\Http\Controllers\Controller;
use App\Media;
use App\Promotion;
use Exception;

class PromotionController extends Controller
{
    protected $media;

    public function __construct(CommonContainer $media)
    {
        return $this->media = $media;
    }

    public function addPromotion(Request $request)
    {
        try {
            $data = JWTAuth::user();

            $promotion = new Promotion();
            $promotion->user_id = $data->id;
            $promotion->name = $request->name;
            $promotion->description = $request->description;
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
            //throw $th;
            return response()->json(['success' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }
    public function getPromotion(Request $request)
    {
        try {
            $data = JWTAuth::user();
            $promotion = Promotion::with('user')->get();
            return  response()->json([
                'success' => true,
                'data' => $promotion,
            ]);

        } catch (\Exception $ex) {
            //throw $th;
            return response()->json(['success' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }
}
