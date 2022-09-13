<?php

namespace App\Http\Controllers\frontend;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
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
        if ($request->ajax()) {
            // $customer_id=intval($request->customer_id);
            $room_id=intval($request->room_id);



            if (Review::where('customer_id', Auth::guard('customer')->user()->id)->where('room_id',$room_id)->exists()) {
                // dd('user found update his review');
                $updateReview = Review::where('customer_id', '=', Auth::guard('customer')->user()->id)->first();
                $status =  $updateReview->update([
                    'customer_review' =>$request->customer_review,
                    'star'=> $request->star,
                ]);
                if ($status) {
                    return response()->json([
                        'status' => 200,
                        'msg' => 'Thanks for your new review!'
                    ]);
                }
            } else {
                $status = Review::create([
                    'room_id' =>$room_id,
                    'customer_id'=>Auth::guard('customer')->user()->id,
                    'customer_review' =>$request->customer_review,
                    'star'=> $request->star,
                ]);
                if ($status) {
                    return response()->json([
                        'status' => 200,
                        'msg' => 'Thanks for your review!'
                    ]);
                }
            }
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
