<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Trip;
use App\Models\Booking;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController
{
    public function index()
    {
        $totalVehicles = Vehicle::count();
        $totalTrips = Trip::count();
        $totalBookings = Booking::count();
        $totalUsers = User::count();

        $bookingsByStatus = Booking::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $revenueTotal = Payment::where('status', 'completed')->sum('amount');

        $fromMonth = Carbon::now()->subMonths(11)->startOfMonth();

        $bookingsMonthlyRaw = Booking::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COUNT(*) as total")
            ->where('created_at', '>=', $fromMonth)
            ->groupBy('ym')
            ->orderBy('ym')
            ->get();

        $revenueMonthlyRaw = Payment::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, SUM(amount) as total")
            ->where('status', 'completed')
            ->where('created_at', '>=', $fromMonth)
            ->groupBy('ym')
            ->orderBy('ym')
            ->get();

        $months = collect(range(0, 11))
            ->map(fn ($i) => Carbon::now()->subMonths(11 - $i)->format('Y-m'));
        $bookingsMonthly = $months->map(fn ($m) => (int) ($bookingsMonthlyRaw->firstWhere('ym', $m)->total ?? 0));
        $revenueMonthly = $months->map(fn ($m) => (float) ($revenueMonthlyRaw->firstWhere('ym', $m)->total ?? 0));

        $topRoutesRaw = Booking::query()
            ->select('routes.id', DB::raw('CONCAT(s1.name, " → ", s2.name) as name'), DB::raw('COUNT(bookings.id) as total'))
            ->join('trips', 'bookings.trip_id', '=', 'trips.id')
            ->join('routes', 'trips.route_id', '=', 'routes.id')
            ->leftJoin('stations as s1', 'routes.start_station_id', '=', 's1.id')
            ->leftJoin('stations as s2', 'routes.end_station_id', '=', 's2.id')
            ->groupBy('routes.id', 'name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $recentBookings = Booking::with(['user', 'trip.route.startStation', 'trip.route.endStation'])
            ->latest()
            ->take(5)
            ->get();

        $recentUsers = User::latest()->take(5)->get();

        $upcomingTrips = Trip::with(['vehicle', 'route.startStation', 'route.endStation'])
            ->where('departure_time', '>=', Carbon::now())
            ->orderBy('departure_time')
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'totalVehicles' => $totalVehicles,
            'totalTrips' => $totalTrips,
            'totalBookings' => $totalBookings,
            'totalUsers' => $totalUsers,
            'bookingsByStatus' => $bookingsByStatus,
            'revenueTotal' => $revenueTotal,
            'months' => $months,
            'bookingsMonthly' => $bookingsMonthly,
            'revenueMonthly' => $revenueMonthly,
            'topRoutes' => $topRoutesRaw,
            'recentBookings' => $recentBookings,
            'recentUsers' => $recentUsers,
            'upcomingTrips' => $upcomingTrips,
        ]);
    }
}


