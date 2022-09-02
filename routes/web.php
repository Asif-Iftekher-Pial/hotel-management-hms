<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\RoomController;
use App\Http\Controllers\backend\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// backend routes
Route::get('/',[HomeController::class,'home'])->name('home');


Route::resource('/dashboard',HomeController::class);


// RoomTypes
Route::resource('/room',RoomController::class);
Route::post('/roomType-status',[RoomController::class,'roomStatus'])->name('roomStatus');

// Room
Route::get('/allRooms',[RoomController::class,'allRooms'])->name('allRooms');
Route::post('/create-room',[RoomController::class,'roomCreate'])->name('createRoom');
Route::post('/view-room/{id}',[RoomController::class,'roomView'])->name('roomView');
Route::get('/edit-room/{id}',[RoomController::class,'roomEdit'])->name('editRoom');
Route::put('/update-room/{id}',[RoomController::class,'roomUpdate'])->name('roomUpdate');
Route::delete('/delete-room/{id}',[RoomController::class,'destroyRoom'])->name('destroyRoom');

// Customers

Route::resource('/customers',CustomerController::class);
