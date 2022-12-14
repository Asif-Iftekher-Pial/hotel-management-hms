<?php

namespace App\Http\Controllers\frontend;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;

class FrontHomeController extends Controller
{
    public function home()
    {
        $roomType = RoomType::with('room_type_image', 'rooms')->orderBy('id', 'desc')->get()->random(3);
        //   dd($roomType);
       
        foreach ($roomType as $value) {
            # code...
            foreach ($value->room_type_image as $key) {
                $t = $key->photo;

                # code...
            }
        }
        $test = $t;
        $getService = RoomService::orderBy('id', 'desc')->get()->random(6);

        $getRooms = Room::orderBy('id', 'desc')->with('roomType','service')->get()->random(4);
        //   dd($getRooms);
        $testimonials =Review::orderBy('id', 'desc')->with('customer')->get();
        // dd($testimonials);
        return view('frontend.layouts.home.home', compact('roomType', 'test','getService','getRooms','testimonials'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
