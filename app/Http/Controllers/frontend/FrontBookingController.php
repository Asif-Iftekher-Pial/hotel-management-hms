<?php

namespace App\Http\Controllers\frontend;

use App\Models\Room;
use App\Models\Review;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FrontBookingController extends Controller
{

    public function availabileRooms()
    {
        // dd($checkinDate);
        // $aroom=DB::SELECT("SELECT * FROM rooms WHERE id NOT IN (SELECT room_id FROM bookings WHERE 
        // '$checkinDate' BETWEEN checkin AND checkout )");
        $checkinDate =  $_GET['checkinDate'];
        //   $checkoutDate=  $_GET['checkoutDate'];
        $alreadyBooked = Booking::select('room_id')->where([['checkout', '>=', $checkinDate]])->get();
        // dd($alreadyBooked);
        $GetRoom = Room::where('status', 'active')->whereNotIn('id', $alreadyBooked)->with('service')->get();
        //    return $GetRoom;
        return view('frontend.layouts.room.rooms', compact('GetRoom'));
        // return response()->json(['data'=>$freeRoom]);
    }

    public function allRooms(Request $request)
    {
        $GetRoom = Room::where(['status' => 'active'])->with('service', 'roomType')->orderBy('id', 'desc')->paginate(3);

        if ($request->ajax()) {
            $allRoomView = view('frontend.layouts.includes.allRoomInclude', compact('GetRoom'))->render();
            // dd($allRoomView);
            return response()->json([
                'allRoomView' => $allRoomView
            ]);
        }
        return view('frontend.layouts.room.all_rooms', compact('GetRoom'));
    }

    public function room_detail($id)
    {
        $getRoom = Room::where(['id' => $id], ['status' => 'active'])->with('service', 'roomType')->first();
        $reviews = Review::where('room_id', $id)->with('customer')->latest()->limit(3)->get();
        // dd($reviews);
        return view('frontend.layouts.room.room_detail', compact('getRoom', 'reviews'));
    }

    public function checkAvailability(Request $request)
    {
        $string = $request->room_id;
        $room_id = intval($string);
        $checkin = $request->checkin;
        $checkout = $request->checkout;

        if ($checkin < $checkout) {
            // dd($request->id);
            $booked_room = Booking::where('room_id', $room_id)->exists();
            if ($booked_room) {
                //  dd('found this room check the checkout date');
                $this_room = Booking::where('room_id', $room_id)->first();
                if ($this_room->checkout > $checkin) {
                    // dd('this room is reserved in your checkin date ,please select farther date');
                    return response()->json([
                        'message' => 'Already Reserved! Please select farther date'
                    ]);
                } else {
                    // dd('this room is free and available for bookings');
                    return response()->json([
                        'status' => 200,
                        'message' => 'Room is free for reservation'
                    ]);
                }
            } else {
                // dd('not found this room ,Direct available');
                return response()->json([
                    'status' => 200,
                    'message' => 'Room is free for reservation'
                ]);
            }
        } else {
            // checkin must be smaller then checkout
            return response()->json([
                'message' => 'Checkin must be smaller then Checkout'
            ]);
        }
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
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'room_id' => 'required',
            'customer_id' => 'required',
            'checkout' => 'required',
            'checkin' => 'required',
            'total_adults' => 'required',
            'total_children' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {
            $string = $request->room_id;
            $room_id = intval($string);
            $checkin = $request->checkin;
            $checkout = $request->checkout;
            if ($checkin < $checkout) {
                // dd($request->id);
                $booked_room = Booking::where([['room_id', $room_id], ['customer_id', $request->customer_id]])->exists();
                if ($booked_room) {
                    // dd('you have already booked this room');
                    return response()->json([
                        'status' => 400,
                        'message' => 'you have already booked this room'
                    ]);
                } else {
                    // dd('not found this room with this user ,so check their check in date');
                    $this_room = Booking::where('room_id', $room_id)->first();
                    if ($this_room->checkout > $checkin) {
                        // dd('this room is reserved in your checkin date ,please select farther date');
                        return response()->json([
                            'status' => 400,
                            'message' => 'Already Reserved! Please select farther date'
                        ]);
                    } else {
                        // dd('this room is free and available for bookings with valid check in date');

                        $booking = new Booking();
                        $booking->room_id = $room_id;
                        $booking->checkin = $checkin;
                        $booking->checkout = $checkout;
                        $booking->total_children = $request->total_children;
                        $booking->total_adults = $request->total_adults;
                        $status = $booking->save();
                        $headerRender = view('frontend.layouts.includes.headerAjaxrender')->render();
                        if ($status) {
                            return response()->json([
                                'status' => 200,
                                'message' => 'Room booked successfully!',
                                'headerRender' => $headerRender
                            ]);
                        } else {
                            abort(404);
                        }
                    }
                }
            } else {
                // checkin must be smaller then checkout
                return response()->json([
                    'status' => 400,
                    'message' => 'Checkin must be smaller then Checkout'
                ]);
            }
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
