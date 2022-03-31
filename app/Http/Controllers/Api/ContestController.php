<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use JWTAuth;
use App\Service;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use App\Contest;
use App\Http\Controllers\Controller;
use App\Media;
use App\Participant;
use App\Vote;
use Exception;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;

class ContestController extends Controller
{
    protected $media;

    public function __construct(CommonContainer $media)
    {
        return $this->media = $media;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getContest(Request $request)
    {
        $user = JWTAuth::user();
        // $path=;
        // return $path;
        try {
            $contests = Contest::orderBy('contests.id', 'Desc');
            if ($request->type == 'all') {
            } elseif ($request->type == 'my_contest') {
                # code...
                $contests = $contests->select('contests.*')->join('participants', 'participants.contest_id', '=', 'contests.id')->where('participants.user_id', $user->id);
            } elseif ($request->type == 'active') {
                # code...
                $contests = $contests->where('status', 1);
            } elseif ($request->type == 'new') {
                # code...
            } else {
            }
            $contests = $contests->get();

            return  response()->json([
                'success' => true,
                'data' => $contests,
            ]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e], 400);
        }
    }

    public function getParticipateViaContest($id)
    {
        try {
            //code...
            $data['contest'] =  Contest::where('id', $id)->first();
            $data['contest']->participants =  Participant::withCount('vote')->with('user', 'media')->where('contest_id', $id)->get();

            return  response()->json([
                'success' => true,
                'data' => $data,
            ]);
        } catch (Exception $e) {
            //throw $th;
            return response()->json(['success' => false, 'message' => $e], 400);
        }
    }
    public function addParticipate(Request $request)
    {
        $data = JWTAuth::user();
        try {
            //code...
            $check = Participant::where('contest_id', $request->contest_id)->where('user_id', $data->id)->count();
            if ($check != 0) {
                return  response()->json([
                    'success' => false,
                    'message' => 'You have already participanted in the contest'
                ]);
            }
            $participant = new Participant;
            $participant->user_id = $data->id;
            $participant->contest_id = $request->contest_id;
            $participant->title = $request->title;
            $participant->description = $request->description;
            $participant->save();
            for ($i = 0; $i < count($request->file('img')); $i++) {
                # code...
                if ($request->hasFile('img')) {
                    $image = $request->file('img')[$i];
                    $name  = $this->media->getFileName($image);
                    $path  = $this->media->getProfilePicPath('media');
                    $image->move($path, $name);
                    $uploadmedia = new Media();
                    $uploadmedia->user_id = $data->id;
                    $uploadmedia->file = $name;
                    $uploadmedia->type = '4';
                    $uploadmedia->media_against = $participant->id;
                    if ($uploadmedia->save()) {
                    }
                }
            }
            return  response()->json([
                'success' => true,
                'message' => 'You have participanted in the contest successfully'
            ]);
        } catch (\Exception $ex) {
            //throw $th;
            return response()->json(['success' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }
    public function vote(Request $request)
    {
        $data = JWTAuth::user();
        $vote = Vote::where('user_id', $data->id)->where('participate_id', $request->participate_id)->first();
        if ($vote) {
            $vote->delete();
            return response()->json([
                'success' => true,
                'message' => 'Vote successfully remove.',
            ], 200);
        } else {
            try {
                $vote = new Vote;
                $vote->user_id = $data->id;
                $vote->participate_id = $request->participate_id;
                $vote->vote = 1;
                if ($vote->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Vote successfully saved.',
                    ], 200);
                }
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'data' => 'something goes wrong'], 400);
            }
        }
    }
    public function getParticipateById($id = null)
    {
        try {
            //code...
            $data =  Participant::withCount('vote')->with('user', 'media', 'feedbacks.user:id,name,img','contest')->where('id', $id)->get()->makeHidden(['email', 'email_verified_at']);

            return  response()->json([
                'success' => true,
                'data' => $data,
            ]);
        } catch (Exception $e) {
            //throw $th;
            return response()->json(['success' => false, 'message' => $e], 400);
        }
    }

    public function participateAddFeedback(Request $request)
    {
        $user = JWTAuth::user();

        try {
            //code...
            if(isset($request->participant_id))
            {
               $check = Comment::store($request->participant_id,$request->message,0,2);

               if($check)
               {
                return response()->json([
                    'success' => true,
                    'message' => 'Feedback saved successfully.',
                ], 200);
               }
            }

        } catch (Exception $e) {
            //throw $th;
            return response()->json(['success' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }
    public function getContestWinner(Request $request)
    {
        $user = JWTAuth::user();

        try {
            $contests = Contest::orderBy('contests.id', 'Desc');

        } catch (Exception $e) {
            //throw $th;
            return response()->json(['success' => false, 'message' => 'Something Went Wrong'], 400);
        }
    }
}
