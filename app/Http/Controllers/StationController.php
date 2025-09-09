<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;

class StationController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stations = Station::paginate(100);

        return view('admin.stations.index', compact('stations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        Station::create($validated);

        return redirect()->route('stations.index')->with('success', 'Station created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Station $station)
    {
        $station->load(['routesAsStart.endStation', 'routesAsEnd.startStation']);

        return view('admin.stations.show', compact('station'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Station $station)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $station->update($validated);

        return redirect()->route('stations.index')->with('success', 'Station updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Station $station)
    {
        return view('admin.stations.edit', compact('station'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Station $station)
    {
        $station->delete();

        return redirect()->route('stations.index')->with('success', 'Station deleted successfully.');
    }
}
