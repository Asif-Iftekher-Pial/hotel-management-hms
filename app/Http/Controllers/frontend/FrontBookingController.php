<?php

namespace App\Http\Controllers\frontend;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FrontBookingController extends Controller
{

    public function availabileRooms(){
        // dd($checkinDate);
        // $aroom=DB::SELECT("SELECT * FROM rooms WHERE id NOT IN (SELECT room_id FROM bookings WHERE 
        // '$checkinDate' BETWEEN checkin AND checkout )");
      $checkinDate=  $_GET['checkinDate'];
    //   $checkoutDate=  $_GET['checkoutDate'];
       $alreadyBooked= Booking::select('room_id')->where([['checkout','>=',$checkinDate]])->get();
    // dd($alreadyBooked);
       $GetRoom= Room::where('status','active')->whereNotIn('id',$alreadyBooked)->with('service')->get();
    //    return $GetRoom;
    return view('frontend.layouts.room.rooms',compact('GetRoom'));
        // return response()->json(['data'=>$freeRoom]);
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
