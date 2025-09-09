<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class SeatController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seats = Seat::with('vehicle')->paginate(100);

        return view('admin.seats.index', compact('seats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::all();

        return view('admin.seats.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'seat_number' => 'required|string|max:10',
        ]);

        Seat::create($validated);

        return redirect()->route('seats.index')->with('success', 'Seat created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seat $seat)
    {
        $seat->load('vehicle');

        return view('admin.seats.show', compact('seat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seat $seat)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'seat_number' => 'required|string|max:10',
        ]);

        $seat->update($validated);

        return redirect()->route('seats.index')->with('success', 'Seat updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seat $seat)
    {
        $vehicles = Vehicle::all();

        return view('admin.seats.edit', compact('seat', 'vehicles'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seat $seat)
    {
        $seat->delete();

        return redirect()->route('seats.index')->with('success', 'Seat deleted successfully.');
    }
}
