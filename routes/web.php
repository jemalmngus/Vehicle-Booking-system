<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TripScheduleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('vehicles', VehicleController::class);
    Route::resource('vehicle-types', VehicleTypeController::class);
    Route::resource('stations', StationController::class);
    Route::resource('routes', RouteController::class);
    Route::resource('trips', TripController::class);
    Route::resource('seats', SeatController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('notifications', NotificationController::class);
    Route::resource('trip-schedules', TripScheduleController::class);
    Route::resource('users', UserController::class);
});
require __DIR__ . '/auth.php';
