<?php


namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::paginate(100);
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $trips = Trip::all();

        return view('admin.bookings.create', compact('users', 'trips'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'trip_id' => 'required|exists:trips,id',
            'seat_number' => 'required|string|max:10',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        Booking::create($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }




    public function show(Booking $booking)
    {
        // Eager load relations (user and trip) to avoid N+1 queries
        $booking->load(['user', 'trip']);

        return view('admin.bookings.show', compact('booking'));
    }


    /**
     * Show the form for editing the specified resource.
     */




    public function edit(Booking $booking)
    {
        $users = User::all();
        $trips = Trip::all();

        return view('admin.bookings.edit', compact('booking', 'users', 'trips'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'trip_id' => 'required|exists:trips,id',
            'seat_number' => 'required|string|max:10',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
