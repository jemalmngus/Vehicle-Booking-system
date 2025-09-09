<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\{
    VehicleController,
    VehicleTypeController,
    StationController,
    RouteController,
    TripController,
    SeatController,
    BookingController,
    PaymentController,
    NotificationController,
    TripScheduleController,
    AuthController,
    UserController
};

// Public API Endpoints (Register & Login)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Group routes that require authentication using Sanctum middleware
Route::middleware('auth:sanctum')->group(function () {
    // API Resources
    Route::apiResource('vehicles', VehicleController::class);
    Route::apiResource('vehicle-types', VehicleTypeController::class);
    Route::apiResource('stations', StationController::class);
    Route::apiResource('routes', RouteController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('trips', TripController::class);
    Route::apiResource('seats', SeatController::class);
    Route::apiResource('payments', PaymentController::class);
    Route::apiResource('notifications', NotificationController::class);
    Route::apiResource('trip-schedules', TripScheduleController::class);
    Route::middleware('auth:sanctum')->get('/my-bookings', [BookingController::class, 'myBookings']);

    // Logout endpoint
    Route::apiResource('bookings', BookingController::class);
    Route::post('logout', [AuthController::class, 'logout']);
});
