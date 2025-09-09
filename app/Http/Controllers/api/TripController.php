<?php

namespace App\Http\Controllers\API;

use App\Models\Trip;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TripController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::with(['vehicle.type', 'route.startStation', 'route.endStation'])->paginate(10);
        return response()->json($trips);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_id' => 'required|exists:vehicles,id',
            'route_id' => 'required|exists:routes,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
        ]);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);
        $trip = Trip::create($validator->validated());
        return response()->json($trip->load(['vehicle.type','route.startStation','route.endStation']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $trip = Trip::with(['vehicle.type','route.startStation','route.endStation','bookings.user'])->find($id);
        if (!$trip) return response()->json(['message' => 'Not found'], 404);
        return response()->json($trip);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $trip = Trip::find($id);
        if (!$trip) return response()->json(['message' => 'Not found'], 404);
        $validator = Validator::make($request->all(), [
            'vehicle_id' => 'sometimes|exists:vehicles,id',
            'route_id' => 'sometimes|exists:routes,id',
            'departure_time' => 'sometimes|date',
            'arrival_time' => 'sometimes|date|after:departure_time',
        ]);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);
        $trip->update($validator->validated());
        return response()->json($trip->load(['vehicle.type','route.startStation','route.endStation']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $trip = Trip::find($id);
        if (!$trip) return response()->json(['message' => 'Not found'], 404);
        $trip->delete();
        return response()->json(['message' => 'Trip deleted successfully']);
    }
}
