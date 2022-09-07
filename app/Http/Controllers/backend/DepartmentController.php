<?php

namespace App\Http\Controllers\backend;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData=Department::all();
        return view('backend.layouts.departments.index', compact('getData'));
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
            'title' => 'string|required',
            'detail' => 'string|required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {
           
            $dept = new Department();
            $dept->title = $request->title;
            $dept->detail = $request->detail;
            $status= $dept->save();
            if ($status) {
                return response()->json([
                    'status' => 200,
                    'message' => 'department saved successfully!',
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
        $getDept=Department::findOrFail($id);
        if($getDept){
            return response()->json($getDept);
        }else{
            echo "No data found!";
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
            'title' =>'string|required',
            'detail' =>'string|required',
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $getData=Department::findOrFail($id);
            $status= $getData->update([
                'title'=>$request->title,
                'detail'=>$request->detail,
            ]);
            if($status){
                return response()->json([
                    'status' => 200,
                    'message' => 'Department updated successfully!'
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
    public function destroy($id)
    {
        $getData = Department::findOrFail($id);
        if ($getData) {
            $getData->delete();
            return back();
        }
    }
}
