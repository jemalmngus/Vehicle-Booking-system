<?php

namespace App\Http\Controllers;

use App\Models\TripSchedule;
use App\Models\Route as TravelRoute;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TripScheduleController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tripSchedules = TripSchedule::with(['route.startStation', 'route.endStation', 'vehicle.type'])
            ->paginate(100);

        return view('admin.trip-schedules.index', compact('tripSchedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes = TravelRoute::with(['startStation', 'endStation'])->get();
        $vehicles = Vehicle::with('type')->get();

        return view('admin.trip-schedules.create', compact('routes', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'trip_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
        ]);

        TripSchedule::create($validated);

        return redirect()->route('trip-schedules.index')->with('success', 'Trip schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TripSchedule $tripSchedule)
    {
        $tripSchedule->load(['route.startStation', 'route.endStation', 'vehicle.type']);

        return view('admin.trip-schedules.show', compact('tripSchedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TripSchedule $tripSchedule)
    {
        $validated = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'trip_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
        ]);

        $tripSchedule->update($validated);

        return redirect()->route('trip-schedules.index')->with('success', 'Trip schedule updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TripSchedule $tripSchedule)
    {
        $routes = TravelRoute::with(['startStation', 'endStation'])->get();
        $vehicles = Vehicle::with('type')->get();

        return view('admin.trip-schedules.edit', compact('tripSchedule', 'routes', 'vehicles'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TripSchedule $tripSchedule)
    {
        $tripSchedule->delete();

        return redirect()->route('trip-schedules.index')->with('success', 'Trip schedule deleted successfully.');
    }
}
