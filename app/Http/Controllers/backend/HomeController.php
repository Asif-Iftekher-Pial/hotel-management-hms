<?php

namespace App\Http\Controllers\backend;

use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    


    public function home(){
        //  pie chart
        // $rtbookings=DB::table('room_types as rt')
        // ->join('rooms as r','r.room_type_id','=','rt.id')
        // ->join('bookings as b','b.room_id','=','r.id')
        // ->select('rt.*','r.*','b.*',DB::raw('count(b.id) as total_bookings'))
        // ->groupBy('r.room_type_id')
        // ->get();
        // // dd($rtbookings);
        // $chartData ="";
        // foreach ($rtbookings as  $rbooking) {
        //     # code...
        //      $plabels[]=$rbooking->detail;
        //      $pdata[]=$rbooking->total_bookings;
        //     $chartData.="{ label: $rbooking->detail, value: $rbooking->total_bookings },";
        //     $arr['chartData'] =rtrim($chartData,",");

        // }
        // //  return $chartData;
        // // dd( $pdata);
        return view('backend.layouts.home.home');
    }

    
    public function index()
    {
        
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
        //
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
