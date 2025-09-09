<?php

namespace App\Http\Controllers\API;

use App\Models\TripSchedule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TripScheduleController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = TripSchedule::with(['route.startStation','route.endStation','vehicle.type'])->paginate(10);
        return response()->json($schedules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'route_id' => 'required|exists:routes,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'trip_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
        ]);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);
        $schedule = TripSchedule::create($validator->validated());
        return response()->json($schedule->load(['route.startStation','route.endStation','vehicle.type']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $schedule = TripSchedule::with(['route.startStation','route.endStation','vehicle.type'])->find($id);
        if (!$schedule) return response()->json(['message' => 'Not found'], 404);
        return response()->json($schedule);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $schedule = TripSchedule::find($id);
        if (!$schedule) return response()->json(['message' => 'Not found'], 404);
        $validator = Validator::make($request->all(), [
            'route_id' => 'sometimes|exists:routes,id',
            'vehicle_id' => 'sometimes|exists:vehicles,id',
            'trip_date' => 'sometimes|date',
            'departure_time' => 'sometimes|date_format:H:i',
        ]);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);
        $schedule->update($validator->validated());
        return response()->json($schedule->load(['route.startStation','route.endStation','vehicle.type']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $schedule = TripSchedule::find($id);
        if (!$schedule) return response()->json(['message' => 'Not found'], 404);
        $schedule->delete();
        return response()->json(['message' => 'Trip schedule deleted successfully']);
    }
}
