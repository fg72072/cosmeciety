<?php

namespace App\Http\Controllers\Api\Barber;

use JWTAuth;
use App\Service;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use App\Http\Controllers\Controller;
use Exception;

class ServiceController extends Controller
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
    public function index()
    {
        //
        try {
            $data = JWTAuth::user();
            $service = Service::where('user_id', $data->id)->get();

            // load the view and pass the sharks
            return $service;
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'something goes wrong'], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = JWTAuth::user();
        //
        if ($request->hasFile('picture')) {
            $request->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $image = $request->file('picture');
            $name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('service');
            $image->move($path, $name);
        } else {
            $name = null;
        }

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'duration' => 'required',

        ]);
        try {
            $service = new Service;
            $service->title = $request->name;
            $service->price = $request->price;
            $service->duration = $request->duration;
            $service->user_id = $data->id;
            $service->description = $request->description;
            $service->picture = $name;
            $service->save();

            return  response()->json([
                'success' => true,
                'message' => 'Service saved successfully'
            ]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'something goes wrong'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $data = JWTAuth::user();
            $service = Service::where('user_id', $data->id)->where('id', $id)->get();

            // load the view and pass the sharks
            return $service;
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'something goes wrong'], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
