<?php

namespace App\Http\Controllers\backend;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRoomTypes = RoomType::orderBy('id', 'desc')->get();
        // dd($allRoomTypes);
        return view('backend.layouts.room.roomType', compact('allRoomTypes'));
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
        $data = $request->validate([
            'title' => 'string|required',
            'price' =>'numeric|required',
            'detail' => 'string|required',
        ]);
        // $data['detail'] = html_entity_decode($request->detail);
        // dd($data['detail']);
        $status = RoomType::create($data);
        if ($status) {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'data saved successfully!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Oops!Something went wrong!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
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
        $data = RoomType::findOrFail($id);
        if ($data) {
            return response()->json($data);
        } else {
            echo 'something went wrong';
        }
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
        // return $request->all();
        $validate = Validator::make($request->all(), [
            'title' => 'required|string',
            'price' =>'numeric|required',
            'detail' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()->all()]);
        } else {
            $data = RoomType::where('id', $request->id)->first();
            $data = $data->update([
                'title' => $request->title,
                'price' => $request->price,
                'detail' => $request->detail,
            ]);
            if ($data) {
                return response()->json([
                    'status' => 200,
                    'message' => 'RoomType updated successfully!'
                ]);
            } else {
                return response()->json(['message' => 'something went wrong']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getData = RoomType::findOrFail($id);
        if ($getData) {
            $getData->delete();
            return back();
        }
    }




    public function roomStatus(Request $request)
    {
        // dd($request->all());
        if ($request->mode == 'true') {
            Room::where('id', $request->id)->update(['status' => 'active']);
        } else {
            Room::where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Status updated successfully!'
        ]);
    }


    public function allRooms(){
        $allRoomTypes = RoomType::get();
        $rooms = Room::with('roomType')->orderBy('id','desc')->get();
        //  dd($rooms);
        return view('backend.layouts.room.room',compact('rooms','allRoomTypes'));
    }

    public function roomCreate(Request $request){
        // return $request->all();

        $validator = Validator::make($request->all(),[
        'title' =>'string|required',
        'status' =>'required',
        'room_type_id' =>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' =>$validator->errors()->all()]);
        }else{
           $data=Room::create($request->all());
            if($data){
                return response()->json([
                    'status' => 200,
                    'message' => 'Room created successfully!'
                ]);
            }
        }
    }

    public function roomEdit($id){
        $findRoom = Room::with('roomType')->findOrFail($id);
        //   dd($findRoom);
        if($findRoom){
            return response()->json($findRoom);
        }
    }

    public function roomUpdate(Request $request){
        // return $request->all();
        $validator = Validator::make($request->all(),[
            'title' =>'string|required',
            'room_type_id'  =>'required',
            'status' =>'required'
        ]);
        if($validator->fails()) {
            return response()->json(['error' =>$validator->errors()->all()]);   
        }else{
            $data=$request->all();
            $ok=Room::where('id', $request->id)->first();
           $status= $ok->fill($data)->save();
            if($status){
                return response()->json([
                    'status'=>200,
                    'message'=>'data updated successfully!'
                ]);
            }
        }
    }

    public function destroyRoom($id)
    {
        $getData = Room::findOrFail($id);
        if ($getData) {
            $getData->delete();
            return back();
        }
    }

}