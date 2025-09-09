<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Station;
use Illuminate\Http\Request;

class RouteController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::with(['startStation', 'endStation'])->paginate(100);

        return view('admin.routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stations = Station::all();

        return view('admin.routes.create', compact('stations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_station_id' => 'required|exists:stations,id|different:end_station_id',
            'end_station_id' => 'required|exists:stations,id',
            'distance_km' => 'required|numeric|min:0',
        ]);

        Route::create($validated);

        return redirect()->route('routes.index')->with('success', 'Route created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        $route->load(['startStation', 'endStation', 'trips.vehicle', 'schedules.vehicle']);

        return view('admin.routes.show', compact('route'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        $validated = $request->validate([
            'start_station_id' => 'required|exists:stations,id|different:end_station_id',
            'end_station_id' => 'required|exists:stations,id',
            'distance_km' => 'required|numeric|min:0',
        ]);

        $route->update($validated);

        return redirect()->route('routes.index')->with('success', 'Route updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        $stations = Station::all();

        return view('admin.routes.edit', compact('route', 'stations'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        $route->delete();

        return redirect()->route('routes.index')->with('success', 'Route deleted successfully.');
    }
}
