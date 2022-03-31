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
            'banner' => 'required|dimensions:max_width=60,max_height=55',
            'title' => 'required',
            'description' => 'required|string',
            'entry_fee' => 'required|numeric',
            'entries_acceptance_date' => 'required',
            'entries_close_date' => 'required',
            'contest_live_date' => 'required',
            'contest_close_date' => 'required',
            'result_announce_date' => 'required',
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
        $contest->entries_acceptance_date = $req->entries_acceptance_date;
        $contest->entries_close_date = $req->entries_close_date;
        $contest->contest_live_date = $req->contest_live_date;
        $contest->contest_close_date = $req->contest_close_date;
        $contest->result_announce_date = $req->result_announce_date;
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
            'entries_acceptance_date' => 'required',
            'entries_close_date' => 'required',
            'contest_live_date' => 'required',
            'contest_close_date' => 'required',
            'result_announce_date' => 'required',
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
        $contest->entries_acceptance_date = $req->entries_acceptance_date;
        $contest->entries_close_date = $req->entries_close_date;
        $contest->contest_live_date = $req->contest_live_date;
        $contest->contest_close_date = $req->contest_close_date;
        $contest->result_announce_date = $req->result_announce_date;
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
