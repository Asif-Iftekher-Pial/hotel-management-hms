<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\RoomController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\StaffController;
use App\Http\Controllers\backend\BookingController;
use App\Http\Controllers\frontend\ReviewController;
use App\Http\Controllers\backend\CustomerController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\backend\DepartmentController;
use App\Http\Controllers\frontend\FrontAuthController;
use App\Http\Controllers\frontend\FrontHomeController;
use App\Http\Controllers\backend\RoomServiceController;
use App\Http\Controllers\frontend\FrontBookingController;

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
            Route::get('/edit-room/{id}', [RoomController::class, 'roomEdit'])->name('editRoom');
            Route::put('/update-room/{id}', [RoomController::class, 'roomUpdate'])->name('roomUpdate');
            Route::delete('/delete-room/{id}', [RoomController::class, 'destroyRoom'])->name('destroyRoom');
        });

        // Room Service
        Route::group(['prefix' =>'service-management'],function(){
            Route::resource('/service',RoomServiceController::class);
        });

        // Customers
        Route::group(['prefix' => 'customer-management'], function () {
            Route::resource('/customers', CustomerController::class);
        });
        // Department
        Route::group(['prefix' => '/manage-department'], function () {
            Route::resource('/departments', DepartmentController::class);
        });
        // Staff-Management
        Route::group(['prefix' => '/manage-staff'], function () {
            Route::resource('/staff', StaffController::class);
            Route::post('/pay-salary', [StaffController::class, 'paySalary'])->name('paySalary');
            Route::get('/all-salaries', [StaffController::class, 'allSalaries'])->name('allSalaries');
            Route::delete('/delete-salaries/{id}', [StaffController::class, 'Salarydestroy'])->name('Salarydestroy');
        });
        // Manage Booking
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

// booking routes with rooms functionality

Route::resource('/customer-booking',FrontBookingController::class);
Route::get('/room-availability',[FrontBookingController::class,'availabileRooms'])->name('frontavailableRooms');
Route::get('/all-room',[FrontBookingController::class,'allRooms'])->name('front.allRooms');
Route::get('/room-detail/{id}',[FrontBookingController::class,'room_detail'])->name('front.room_detail');
Route::post('/check-room-availability',[FrontBookingController::class,'checkAvailability'])->name('checkAvailability');
Route::get('/my-bookings',[FrontBookingController::class,'myBookings'])->name('myBookings');

// review
Route::resource('/customer-review',ReviewController::class);





// SSLCOMMERZ Start
Route::get('/example1/{room_id}/{booking_id}', [SslCommerzPaymentController::class, 'exampleEasyCheckout'])->name('pay_bill');
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
