<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use Illuminate\Support\Facades\Auth;

class ContestController extends Controller
{
    protected $media;

    public function __construct(CommonContainer $media){
        return $this->media = $media;
    }
    
    public function index()
    {
        $contests = Contest::get();      
        return view('contests.list',compact('contests'));
    }

    public function create()
    {
        return view('contests.add');
    }

    public function store(Request $req)
    {
        $validate = Request()->validate([
            'banner' => 'required',
            'title' => 'required',
            'description' => 'required|string',
            'entry_fee' => 'required|numeric',
            'contest_start_date' => 'required',
            'contest_end_date' => 'required',
            'acceptance_date' => 'required',
            'post_live_date' => 'required',
            'announce_date' => 'required',
        ]);
        $contest = new Contest;
        if ($req->hasFile('banner')) {
            $image = $req->file('banner');
            $name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('contest');
            $image->move($path, $name);
            $contest->banner = $name;
        }
        $contest->user_id = Auth::user()->id;
        $contest->title = $req->title;
        $contest->description = $req->description;
        $contest->entry_fee = $req->entry_fee;
        $contest->contest_start_date = $req->contest_start_date;
        $contest->contest_end_date = $req->contest_end_date;
        $contest->acceptance_date = $req->acceptance_date;
        $contest->post_live_date = $req->post_live_date;
        $contest->announce_date = $req->announce_date;
        $contest->status = $req->status;
        $contest->save();
        return back();
    }

    public function edit($id)
    {
        $contest = Contest::where('id',$id)->first();
        return view('contests.edit',compact('contest'));
    }

    public function update($id,Request $req)
    {
        $validate = Request()->validate([
            'title' => 'required',
            'description' => 'required|string',
            'entry_fee' => 'required|numeric',
            'contest_start_date' => 'required',
            'contest_end_date' => 'required',
            'acceptance_date' => 'required',
            'post_live_date' => 'required',
            'announce_date' => 'required',
        ]);
        $contest = Contest::find($id);
        if ($req->hasFile('banner')) {
            $image = $req->file('banner');
            $this->media->unlinkProfilePic($contest->banner,'contest');
            $name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('contest');
            $image->move($path, $name);
            $contest->banner = $name;
        }
        $contest->title = $req->title;
        $contest->description = $req->description;
        $contest->entry_fee = $req->entry_fee;
        $contest->contest_start_date = $req->contest_start_date;
        $contest->contest_end_date = $req->contest_end_date;
        $contest->acceptance_date = $req->acceptance_date;
        $contest->post_live_date = $req->post_live_date;
        $contest->announce_date = $req->announce_date;
        $contest->status = $req->status;
        $contest->save();
        return back();
    }

    public function destroy($id)
    {
        $contest = Contest::where('id',$id);
        $contest->delete();
        return back();
    }
}
