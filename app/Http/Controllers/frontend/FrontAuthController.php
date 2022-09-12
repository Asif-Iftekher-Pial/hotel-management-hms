<?php

namespace App\Http\Controllers\frontend;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class FrontAuthController extends Controller
{
    public function login()
    {
        Session::put('url.intended',URL::previous());
        return view('frontend.layouts.auth.login');
    }

    public function registration(Request $request)
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
                    'message' => 'Registration Successfull!',
                ]);
            }
        }
    }

    public function customerLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('customer')->attempt($credentials)) {
            // dd('ok');
            Session::put('customer', $request->email);
            $status = Customer::where('id', Auth::guard('customer')->user()->id)->first(); //this will find query will authorized logged in user by his ID 

            // dd($status);
            $status->update([
                'status' => 'active'
            ]);
            // dd($status->status);
            if ($request->has('rememberme')) {
                Cookie::queue('frontendcookieNameEmail', $request->email, 1440); /* 1440 means cookie will clear after 24 hours*/
                Cookie::queue('frontendcookieNamePassword', $request->password, 1440);
            }
            if (Session::get('url.intended')) {
                $notification = array(
                    'T-messege'  => 'Welcome back ' . Auth::guard('customer')->user()->full_name,
                    'alert-type' => 'success'
                );
                return Redirect::to(Session::get('url.intended'))->with($notification);
            } else {
                $notification = array(
                    // 'T-messege' => 'welcome '.$request->name.'!',
                    'T-messege' => 'Welcome ' . Auth::guard('customer')->user()->full_name,
                    'alert-type' => 'success'
                );
                return redirect()->route('front.home')->with($notification);
            }
        } else {
            // return back()->with('error', 'Wrong email or password');
            return back()->withErrors([
                'email' => 'The provided information did not match our records.',
            ]);
        }
    }

    public function customerLogout()
    {
        $status=Customer::where('id','=',Auth::guard('customer')->user()->id)->first();
        //dd($status);
        
        $status->update([
            'status'=> 'inactive'
        ]);
        Auth::logout();
        session()->flush();
        //dd($request->all());
        $notification = array(
            // 'T-messege' => 'welcome '.$request->name.'!',
            'T-messege' => 'Customer Logout successfull',
            'alert-type' => 'success'
        );
        return redirect()->route('front.login')->with($notification);
    }
}
