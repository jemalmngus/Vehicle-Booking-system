<?php

namespace App\Http\Controllers\API;

use App\Models\VehicleType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class VehicleTypeController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(VehicleType::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:vehicle_types,name',
            'price_per_km' => 'required|numeric|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $type = VehicleType::create($validator->validated());
        return response()->json($type, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $type = VehicleType::with('vehicles')->find($id);
        if (!$type) return response()->json(['message' => 'Not found'], 404);
        return response()->json($type);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $type = VehicleType::find($id);
        if (!$type) return response()->json(['message' => 'Not found'], 404);
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255|unique:vehicle_types,name,' . $type->id,
            'price_per_km' => 'sometimes|numeric|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $type->update($validator->validated());
        return response()->json($type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $type = VehicleType::find($id);
        if (!$type) return response()->json(['message' => 'Not found'], 404);
        $type->delete();
        return response()->json(['message' => 'Vehicle type deleted successfully']);
    }
}
