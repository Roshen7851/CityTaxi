<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\PassengerDashboardController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\UserRegisterController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/user-dashboard',[PassengerDashboardController::class,'index'])->name('user.dashboard');
    Route::get('/call-center-dashboard',[PassengerDashboardController::class,'CallCenterDashboard'])->name('call_center.dashboard');
    Route::post('/ride',[RideController::class,'store'])->name('ride.start');
    Route::get('/ongoing-ride/{ride}',[RideController::class,'ongoing'])->name('ride.ongoing');
    Route::post('/cancel-ride',[RideController::class,'cancelRide'])->name('ride.cancel');
    Route::get('/ride-list',[RideController::class,'index'])->name('ride.list');
    Route::post('/ride-payment',[RideController::class,'payment'])->name('ride.payment');
    Route::get('/ride-review/{ride}',[RideController::class,'review'])->name('ride.review');
    Route::post('/rate-now',[RideController::class,'rateNow'])->name('ride.rate');

    Route::post('/ride-reject',[RideController::class,'rideReject'])->name('ride.reject');
    Route::post('/ride-accept',[RideController::class,'rideAccept'])->name('ride.accept');
    Route::post('/ride-request-payment',[RideController::class,'requestPayment'])->name('ride.request.payment');

    Route::get('/driver-dashboard', function () {
        return Inertia::render('DriverDashboard');
    })->name('driver.dashboard');

    Route::get('/admin-dashboard', function () {
        return Inertia::render('AdminDashboard');
    })->name('admin.dashboard');

});



//Route::get('/payment', function () {
//    return Inertia::render('RidePayment');
//})->name('call_center.dashboard');
//
//Route::get('/rating', function () {
//    return Inertia::render('RideRating');
//})->name('call_center.dashboard');


Route::get('/register-driver', [UserRegisterController::class, 'registerDriverView']);
Route::post('/register-driver', [UserRegisterController::class, 'registerDriver'])->name('register-driver');
Route::post('/register-passenger', [UserRegisterController::class, 'registerPassenger'])->name('register-passenger');

Route::get('/driver-list', [AdminController::class, 'drivers'])->name('driver-list');
Route::get('/passenger-list', [AdminController::class, 'passengers'])->name('passenger-list');
Route::get('/guest-list', [AdminController::class, 'guests'])->name('guest-list');
Route::get('/vehicles-list', [AdminController::class, 'vehicles'])->name('vehicle-list');


Route::get('debug',[DebugController::class,'index']);
