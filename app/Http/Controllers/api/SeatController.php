<?php

namespace App\Http\Controllers\API;

use App\Models\Seat;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SeatController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Seat::with('vehicle')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_id' => 'required|exists:vehicles,id',
            'seat_number' => 'required|string|max:10',
        ]);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);
        $seat = Seat::create($validator->validated());
        return response()->json($seat->load('vehicle'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $seat = Seat::with('vehicle')->find($id);
        if (!$seat) return response()->json(['message' => 'Not found'], 404);
        return response()->json($seat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $seat = Seat::find($id);
        if (!$seat) return response()->json(['message' => 'Not found'], 404);
        $validator = Validator::make($request->all(), [
            'vehicle_id' => 'sometimes|exists:vehicles,id',
            'seat_number' => 'sometimes|string|max:10',
        ]);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);
        $seat->update($validator->validated());
        return response()->json($seat->load('vehicle'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $seat = Seat::find($id);
        if (!$seat) return response()->json(['message' => 'Not found'], 404);
        $seat->delete();
        return response()->json(['message' => 'Seat deleted successfully']);
    }
}
