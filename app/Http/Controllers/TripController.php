<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Vehicle;
use App\Models\Route as TravelRoute;
use Illuminate\Http\Request;

class TripController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::with(['vehicle.type', 'route.startStation', 'route.endStation'])
            ->paginate(100);

        return view('admin.trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::with('type')->get();
        $routes = TravelRoute::with(['startStation', 'endStation'])->get();

        return view('admin.trips.create', compact('vehicles', 'routes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'route_id' => 'required|exists:routes,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
        ]);

        Trip::create($validated);

        return redirect()->route('trips.index')->with('success', 'Trip created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        $trip->load(['vehicle.type', 'route.startStation', 'route.endStation', 'bookings.user']);

        return view('admin.trips.show', compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'route_id' => 'required|exists:routes,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
        ]);

        $trip->update($validated);

        return redirect()->route('trips.index')->with('success', 'Trip updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        $vehicles = Vehicle::with('type')->get();
        $routes = TravelRoute::with(['startStation', 'endStation'])->get();

        return view('admin.trips.edit', compact('trip', 'vehicles', 'routes'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();

        return redirect()->route('trips.index')->with('success', 'Trip deleted successfully.');
    }
}
