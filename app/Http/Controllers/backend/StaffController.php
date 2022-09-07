<?php

namespace App\Http\Controllers\backend;

use App\Models\Staff;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = Staff::with('department')->orderBy('id', 'desc')->get();
        // dd($getData);
        $allDept = Department::all();
        return view('backend.layouts.staff.index', compact('getData', 'allDept'));
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
        $validator = Validator::make($request->all(), [
            'full_name' => 'string|required',
            'department_id' => 'required',
            'bio' => 'required',
            'salary_type' => 'required',
            'salary_amt' => 'required|numeric',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {
            if ($request->file('photo')) {
                $file = $request->file('photo');
                $filename = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/img/staff/'), $filename);
            }
            $staff = new Staff();
            $staff->full_name       = $request->full_name;
            $staff->department_id   = $request->department_id;
            $staff->bio             = $request->bio;
            $staff->salary_type     = $request->salary_type;
            $staff->salary_amt      = $request->salary_amt;
            $staff->photo           = $filename;
            $status                 = $staff->save();
            if ($status) {
                return response()->json([
                    'status' => 200,
                    'message' => 'staff saved successfully!',
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
        $showStaff=Staff::findOrFail($id);
        if($showStaff){
            return response()->json($showStaff);
        }else{
            abort(404);
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
        $getStaff=Staff::findOrFail($id);
        if($getStaff){
            return response()->json($getStaff);
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
        // dd($request->all());
        // dd($request->all());
        $validator=Validator::make($request->all(),[
            'full_name' => 'string|required',
            'department_id' => 'required',
            'bio' => 'required',
            'salary_type' => 'required',
            'salary_amt' => 'required|numeric',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $getData=Staff::findOrFail($id);

            if($request->hasFile('photo')){
                $file=$request->file('photo');
                $filename= date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('assets/img/staff/'),$filename);
                @unlink(public_path('assets/img/staff/'.$getData->photo));
            }
           $status= $getData->update([
                'full_name'=>$request->full_name,
                'department_id'=>$request->department_id,
                'bio'=>$request->bio,
                'salary_type'=>$request->salary_type,
                'salary_amt'=> $request->salary_amt,
                'photo' =>$filename
            ]);
            if($status){
                return response()->json([
                    'status' => 200,
                    'message' => 'Staff updated successfully'
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
        //
        $getData = Staff::findOrFail($id);
        if ($getData) {
            @unlink(public_path('assets/img/staff/'.$getData->photo));
            $getData->delete();
            return back();
        }
    }
}
