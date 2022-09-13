<?php

namespace App\Http\Controllers\backend;

use App\Models\RoomService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RoomServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData=RoomService::all();
        return view('backend.layouts.services.index', compact('getData'));
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
            'service_title' => 'string|required',
            'service_detail' => 'string|required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {
           
            $service = new RoomService();
            $service->service_title = $request->service_title;
            $service->service_detail = $request->service_detail;
            $status= $service->save();
            if ($status) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Service saved successfully!',
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
        $getDept=RoomService::findOrFail($id);
        if($getDept){
            return response()->json($getDept);
        }else{
            abort(404);
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
        $validator=Validator::make($request->all(),[
            'service_title' => 'string|required',
            'service_detail' => 'string|required',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $getData=RoomService::findOrFail($id);
            $status= $getData->update([
                'service_title'=>$request->service_title,
                'service_detail'=>$request->service_detail,
            ]);
            if($status){
                return response()->json([
                    'status' => 200,
                    'message' => 'Service updated successfully!'
                ]);
            }else{
                echo "Something went wrong";
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $getData = RoomService::findOrFail($id);
    //     if ($getData) {
    //         $getData->delete();
    //         return back();
    //     }
    // }

   
}
