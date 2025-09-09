<?php

namespace App\Http\Controllers\API;

use App\Models\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RouteController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::with(['startStation', 'endStation'])->paginate(10);
        return response()->json($routes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_station_id' => 'required|exists:stations,id|different:end_station_id',
            'end_station_id' => 'required|exists:stations,id',
            'distance_km' => 'required|numeric|min:0',
        ]);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);
        $route = Route::create($validator->validated());
        return response()->json($route->load(['startStation','endStation']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $route = Route::with(['startStation', 'endStation'])->find($id);
        if (!$route) return response()->json(['message' => 'Not found'], 404);
        return response()->json($route);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $route = Route::find($id);
        if (!$route) return response()->json(['message' => 'Not found'], 404);
        $validator = Validator::make($request->all(), [
            'start_station_id' => 'sometimes|exists:stations,id|different:end_station_id',
            'end_station_id' => 'sometimes|exists:stations,id',
            'distance_km' => 'sometimes|numeric|min:0',
        ]);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);
        $route->update($validator->validated());
        return response()->json($route->load(['startStation','endStation']));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $route = Route::find($id);
        if (!$route) return response()->json(['message' => 'Not found'], 404);
        $route->delete();
        return response()->json(['message' => 'Route deleted successfully']);
    }
}
