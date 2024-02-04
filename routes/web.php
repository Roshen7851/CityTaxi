<?php

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
    Route::get('/user-dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('user.dashboard');

    Route::get('/driver-dashboard', function () {
        return Inertia::render('DriverDashboard');
    })->name('driver.dashboard');

    Route::get('/admin-dashboard', function () {
        return Inertia::render('AdminDashboard');
    })->name('admin.dashboard');

    Route::get('/call-center-dashboard', function () {
        return Inertia::render('CallCenterDashboard');
    })->name('call_center.dashboard');
});




Route::get('/register-driver', [UserRegisterController::class, 'registerDriverView']);
Route::post('/register-driver', [UserRegisterController::class, 'registerDriver'])->name('register-driver');
Route::post('/register-passenger', [UserRegisterController::class, 'registerPassenger'])->name('register-passenger');



Route::get('/passenger/trips', function () {
    return Inertia::render('PassengerTrips');
});
