<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicleTypes = VehicleType::paginate(100);

        return view('admin.vehicle-types.index', compact('vehicleTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicle-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:vehicle_types,name',
            'price_per_km' => 'required|numeric|min:0',
        ]);

        VehicleType::create($validated);

        return redirect()->route('vehicle-types.index')->with('success', 'Vehicle type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleType $vehicleType)
    {
        $vehicleType->load('vehicles');

        return view('admin.vehicle-types.show', compact('vehicleType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleType $vehicleType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:vehicle_types,name,' . $vehicleType->id,
            'price_per_km' => 'required|numeric|min:0',
        ]);

        $vehicleType->update($validated);

        return redirect()->route('vehicle-types.index')->with('success', 'Vehicle type updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleType $vehicleType)
    {
        return view('admin.vehicle-types.edit', compact('vehicleType'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleType $vehicleType)
    {
        $vehicleType->delete();

        return redirect()->route('vehicle-types.index')->with('success', 'Vehicle type deleted successfully.');
    }
}
