<?php

namespace App\Http\Controllers\API;

use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class VehicleController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::with('type')->paginate(10);
        return response()->json($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'plate_number' => 'required|string|max:50|unique:vehicles,plate_number',
            'total_seats' => 'required|integer|min:1',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'image' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $vehicle = Vehicle::create($validator->validated());
        return response()->json($vehicle->load('type'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vehicle = Vehicle::with('type')->find($id);
        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle not found'], 404);
        }
        return response()->json($vehicle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);
        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'plate_number' => 'sometimes|string|max:50|unique:vehicles,plate_number,' . $vehicle->id,
            'total_seats' => 'sometimes|integer|min:1',
            'vehicle_type_id' => 'sometimes|exists:vehicle_types,id',
            'image' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $vehicle->update($validator->validated());
        return response()->json($vehicle->load('type'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle not found'], 404);
        }
        $vehicle->delete();
        return response()->json(['message' => 'Vehicle deleted successfully']);
    }
}
