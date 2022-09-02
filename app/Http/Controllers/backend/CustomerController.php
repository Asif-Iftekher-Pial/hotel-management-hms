<?php

namespace App\Http\Controllers\backend;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allCustomers = Customer::orderBy('id', 'desc')->get();
        return view('backend.layouts.customers.index', compact('allCustomers'));
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
            'email' => 'string|email|unique:customers',
            'mobile' => 'required',
            'address' => 'string|required',
            'password' => [
                'required', 'string',
                'min:6',               // must be at least 12 characters in length
                'regex:/[a-z]/',       // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',     // must contain a special character
            ],
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {
            if ($request->file('photo')) {
                $file = $request->file('photo');
                $filename = date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/img/customer/'), $filename);
            }
            $customer = new Customer();
            $customer->full_name = $request->full_name;
            $customer->email     = $request->email;
            $customer->mobile    = $request->mobile;
            $customer->address   = $request->address;
            $customer->password  = Hash::make($request->password);
            $customer->photo     = $filename;
            $status              = $customer->save();
            if ($status) {
                return response()->json([
                    'status' => 200,
                    'message' => 'customer saved successfully!',
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
        $getData=Customer::findOrFail($id);
        return view('backend.layouts.customers.show', compact('getData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getCustomer=Customer::findOrFail($id);
        if($getCustomer){
            return response()->json($getCustomer);
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
        // dd($request->all());
        $validator=Validator::make($request->all(),[
            'full_name' =>'string|required',
            'email' =>'string|email|unique:customers',
            'address' =>'string|required',
            'mobile' =>'required',
            'password' => [
                'required', 'string',
                'min:6',               // must be at least 12 characters in length
                'regex:/[a-z]/',       // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',     // must contain a special character
            ],
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $getData=Customer::findOrFail($id);

            if($request->file('photo')){
                $file=$request->file('photo');
                $filename= date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('assets/img/customer/'),$filename);
                @unlink(public_path('assets/img/customer/'.$getData->photo));
            }
           $status= $getData->update([
                'full_name'=>$request->full_name,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'address'=>$request->address,
                'password'=> $request->password,
                'photo' =>$filename
            ]);
            if($status){
                return response()->json([
                    'status' => 200,
                    'message' => 'Customer updated successfully'
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
        $getData = Customer::findOrFail($id);
        if ($getData) {
            @unlink(public_path('assets/img/customer/'.$getData->photo));
            $getData->delete();
            return back();
        }
    }
}
