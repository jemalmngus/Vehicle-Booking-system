<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Trip;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Routing\Controller;

class DashboardController
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalVehicles' => Vehicle::count(),
            'totalTrips' => Trip::count(),
            'totalBookings' => Booking::count(),
            'totalUsers' => User::count()
        ]);
    }
}


