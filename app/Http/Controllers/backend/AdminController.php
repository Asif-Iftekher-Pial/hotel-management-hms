<?php

namespace App\Http\Controllers\backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login(){
        return view('backend.layouts.admin.auth.login');
    }

    public function loginSubmit(Request $request){
        // dd($request->all());
        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator){
            
            $credentials = $request->only('email', 'password');
            if(Auth::guard('admin')->attempt($credentials)){
                $request->session()->regenerate();
                $status= Admin::where('id',Auth::guard('admin')->user()->id)->first();
                // dd($status);
                $status->update(['status' =>'active']);

                if ($request->has('rememberMe')) {
                    Cookie::queue('backendcookieNameEmail', $request->email, 1440); /* 1440 means cookie will clear after 24 hours*/
                    Cookie::queue('backendcookieNamePassword', $request->password, 1440);
                }
                $notification = array(
                    // 'T-messege' => 'welcome '.$request->name.'!',
                    'T-messege' => 'You are Logged in as Admin',
                    'alert-type' => 'success'
                );
                return redirect()->route('home')->with($notification);
               
            }else{
                $notification = array(
                    // 'T-messege' => 'welcome '.$request->name.'!',
                    'T-messege' => 'Oops! wrong email or password',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            }
        }
    }
    public function adminlogout(){
        $status=Admin::where('id','=',Auth::guard('admin')->user()->id);
        //dd($status);
        
        $status->update([
            'status'=> 'inactive'
        ]);
        Auth::logout();
        session()->flush();
        //dd($request->all());
        $notification = array(
            // 'T-messege' => 'welcome '.$request->name.'!',
            'T-messege' => 'Admin Logout successfull',
            'alert-type' => 'success'
        );
        return redirect()->route('login')->with($notification);
        
    }
      
}
