<?php

namespace App\Http\Controllers\API;

use App\Models\Station;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StationController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Station::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);
        $station = Station::create($validator->validated());
        return response()->json($station, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $station = Station::find($id);
        if (!$station) return response()->json(['message' => 'Not found'], 404);
        return response()->json($station);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $station = Station::find($id);
        if (!$station) return response()->json(['message' => 'Not found'], 404);
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);
        $station->update($validator->validated());
        return response()->json($station);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $station = Station::find($id);
        if (!$station) return response()->json(['message' => 'Not found'], 404);
        $station->delete();
        return response()->json(['message' => 'Station deleted successfully']);
    }
}
