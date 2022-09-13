<?php

namespace App\Http\Controllers\backend;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomService;
use App\Models\RoomTypeImage;
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
        // $roomService = RoomService::orderBy('id', 'desc')->get();
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
        // dd($request->all());
        $request->validate([
            'title' => 'string|required',
            'price' => 'numeric|required',
            'detail' => 'string|required',
            // 'imgs' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        // $data['detail'] = html_entity_decode($request->detail);
        // dd($data['detail']);
        $status = RoomType::create([
            'title' => $request->title,
            'price' => $request->price,
            'detail' => $request->detail,
        ]);
        if ($request->has('imgs')) {
            // dd('ok');
            foreach ($request->file('imgs') as  $img) {
                # code...
                // dd($img);
                $filename = date('Ymdhms') . rand(1, 1000) . '.' . $img->getClientOriginalExtension();
                // dd($filename);
                $img->move(public_path('assets/img/roomTypeImages/'), $filename);
                RoomTypeImage::create([
                    'room_type_id' => $status->id,
                    'photo' => $filename,
                    'photo_title' => $status->title
                ]);
            }
        }


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
    public function roomTypeImagesDelete($id)
    {
        $deleteImage = RoomTypeImage::where('id', $id)->first();
        if ($deleteImage) {
            @unlink(public_path('assets/img/roomTypeImages/' . $deleteImage->photo));
            $deleteImage->delete();
            return response()->json(['status' => 200, 'message' => 'deleted successfully!']);
        } else {
            abort(404);
        }
    }
    public function roomTypeImages($id)
    {
        $galleries = RoomType::where('id', $id)->with('room_type_image')->first();
        //  dd($galleries);
        if ($galleries) {
            return view('backend.layouts.room.gallery', compact('galleries'));
        } else {
            abort(404);
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
        $getData = Room::with('service', 'roomType')->findOrFail($id);
        // dd($getData);
        return view('backend.layouts.room.viewRoom', compact('getData'));
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
        //   dd($request->all());
        $validate = Validator::make($request->all(), [
            'title' => 'required|string',
            'price' => 'numeric|required',
            'detail' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()->all()]);
        } else {

            $getdata = RoomType::where('id', $request->id)->first();
            $data = $getdata->update([
                'title' => $request->title,
                'price' => $request->price,
                'detail' => $request->detail,
            ]);
            if ($request->hasFile('imgs')) {
                foreach ($request->file('imgs') as  $img) {
                    # code...
                    // dd($img);
                    $filename = date('Ymdhms') . rand(1, 1000) . '.' . $img->getClientOriginalExtension();
                    // dd($filename);
                    $img->move(public_path('assets/img/roomTypeImages/'), $filename);
                    RoomTypeImage::create([
                        'room_type_id' => $getdata->id,
                        'photo' => $filename,
                        'photo_title' => $getdata->title
                    ]);
                }
            }

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

    public function roomTypeImagesEdit(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'required|string',
            'price' => 'numeric|required',
        ]);
        if ($validated) {
            $getData = RoomType::find($id);
            // dd($getData);
            $status = $getData->update([
                'title' => $request->title,
                'price' => $request->price,
                'detail' => $request->detail,
            ]);
            if ($request->hasFile('imgs')) {
                foreach ($request->file('imgs') as  $img) {
                    # code...
                    // dd($img);
                    $filename = date('Ymdhms') . rand(1, 1000) . '.' . $img->getClientOriginalExtension();
                    // dd($filename);
                    $img->move(public_path('assets/img/roomTypeImages/'), $filename);
                    RoomTypeImage::create([
                        'room_type_id' => $getData->id,
                        'photo' => $filename,
                        'photo_title' => $getData->title
                    ]);
                }
            }

            $notification = array(
                // 'T-messege' => 'welcome '.$request->name.'!',
                'T-messege' => 'Data updated successfullly!',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            abort(404);
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


    public function allRooms()
    {
        $allRoomTypes = RoomType::get();
        $rooms = Room::with('roomType')->orderBy('id', 'desc')->get();
        $roomService = RoomService::orderBy('id', 'desc')->get();
        //  dd($rooms);
        return view('backend.layouts.room.room', compact('rooms', 'allRoomTypes', 'roomService'));
    }

    public function roomCreate(Request $request)
    {
        //   dd($request->all());

        $validator = Validator::make($request->all(), [
            'title' => 'string|required',
            'price' => 'numeric|required',
            'size' =>    'numeric|required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'room_service_id' => 'required',
            'status' => 'required',
            'room_type_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {
            if ($request->file('photo')) {
                $file = $request->file('photo');
                $filename = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/img/room/'), $filename);
                // @unlink(public_path('assets/img/customer/'.$getData->photo));
            }

            $room = new Room();
            $room->title = $request->title;
            $room->price     = $request->price;
            $room->size = $request->size;
            $room->photo = $filename;
            $room->room_service_id = $request->room_service_id;
            $room->status = $request->status;
            $room->room_type_id = $request->room_type_id;
            $data = $room->save();

            if ($data) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Room created successfully!'
                ]);
            }
        }
    }

    public function roomEdit($id)
    {
        $findRoom = Room::with('roomType', 'service')->findOrFail($id);
        //   dd($findRoom);
        if ($findRoom) {
            return response()->json($findRoom);
        }
    }

    public function roomUpdate(Request $request)
    {
        //  return $request->all();
        $validator = Validator::make($request->all(), [
            'title' => 'string|required',
            'price' => 'numeric|required',
            'size' =>    'numeric|required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'room_service_id' => 'required',
            'status' => 'required',
            'room_type_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {

            $ok = Room::where('id', $request->id)->first();
            if ($request->file('photo')) {
                $file = $request->file('photo');
                $filename = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/img/room/'), $filename);
                @unlink(public_path('assets/img/room/' . $ok->photo));
            }
            $status = $ok->update([
                'title' => $request->title,
                'price' => $request->price,
                'size' => $request->size,
                'photo' => $filename,
                'room_service_id' => $request->room_service_id,
                'status' => $request->status,
                'room_type_id' => $request->room_type_id,
            ]);
            if ($status) {
                return response()->json([
                    'status' => 200,
                    'message' => 'data updated successfully!'
                ]);
            }
        }
    }

    public function destroyRoom($id)
    {
        $getData = Room::findOrFail($id);
        if ($getData) {
            @unlink(public_path('assets/img/room/' . $getData->photo));
            $getData->delete();
            return back();
        }
    }
}
