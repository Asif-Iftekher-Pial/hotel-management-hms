<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\RoomController;
use App\Http\Controllers\backend\CustomerController;
use App\Http\Controllers\backend\DepartmentController;
use App\Http\Controllers\backend\StaffController;
use App\Http\Controllers\frontend\FrontAuthController;
use App\Http\Controllers\frontend\FrontBookingController;
use App\Http\Controllers\frontend\FrontHomeController;

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


Route::group(['prefix' => 'app'], function () {
    Route::get('/admin-login', [AdminController::class, 'login'])->name('login');
    Route::post('/admin-login/submit', [AdminController::class, 'loginSubmit'])->name('loginSubmit');
    Route::get('/admin-logout', [AdminController::class, 'adminlogout'])->name('adminlogout');
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/admin', [HomeController::class, 'home'])->name('home');
        Route::resource('/dashboard', HomeController::class);
        Route::group(['prefix' => 'room-management'], function () {
            // RoomTypes
            Route::resource('/room', RoomController::class);
            Route::get('/roomType-images/{id}', [RoomController::class, 'roomTypeImages'])->name('roomTypeImages');
            Route::get('/roomType-images-delete/{id}', [RoomController::class, 'roomTypeImagesDelete'])->name('roomTypeImagesDelete');
            Route::put('/roomType-images-edit/{id}', [RoomController::class, 'roomTypeImagesEdit'])->name('roomTypeImagesEdit');
            Route::post('/roomType-status', [RoomController::class, 'roomStatus'])->name('roomStatus');

            // Room
            Route::get('/allRooms', [RoomController::class, 'allRooms'])->name('allRooms');
            Route::post('/create-room', [RoomController::class, 'roomCreate'])->name('createRoom');
            Route::get('/view-room/{id}', [RoomController::class, 'roomView'])->name('roomView');
            Route::get('/edit-room/{id}', [RoomController::class, 'roomEdit'])->name('editRoom');
            Route::put('/update-room/{id}', [RoomController::class, 'roomUpdate'])->name('roomUpdate');
            Route::delete('/delete-room/{id}', [RoomController::class, 'destroyRoom'])->name('destroyRoom');
        });

        Route::group(['prefix' => 'customer-management'], function () {
            // Customers
            Route::resource('/customers', CustomerController::class);
        });
        Route::group(['prefix' => '/manage-department'], function () {
            Route::resource('/departments', DepartmentController::class);
        });
        Route::group(['prefix' => '/manage-staff'], function () {
            Route::resource('/staff', StaffController::class);
            Route::post('/pay-salary', [StaffController::class, 'paySalary'])->name('paySalary');
            Route::get('/all-salaries', [StaffController::class, 'allSalaries'])->name('allSalaries');
            Route::delete('/delete-salaries/{id}', [StaffController::class, 'Salarydestroy'])->name('Salarydestroy');
        });
        Route::group(['prefix' => '/manage-booking'], function () {
            Route::resource('/bookings', BookingController::class);
            Route::get('/check-available-room/{checkinDate}',[BookingController::class,'availableRooms'])->name('availableRooms');
        });
    });
});



Route::get('/login',[FrontAuthController::class,'login'])->name('front.login');
Route::post('/customer-registration',[FrontAuthController::class,'registration'])->name('front.registration');
Route::post('/customer-login',[FrontAuthController::class,'customerLogin'])->name('front.customerLogin');
Route::get('/customer-logout',[FrontAuthController::class,'customerLogout'])->name('front.customerLogout');

Route::get('/',[FrontHomeController::class,'home'])->name('front.home');
// Route::resource('/ok',FrontHomeController)

// booking routes

Route::resource('/customer-booking',FrontBookingController::class);
Route::get('/room-availability',[FrontBookingController::class,'availabileRooms'])->name('frontavailableRooms');