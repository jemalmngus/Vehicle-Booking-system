<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
class BookingController
{



    public function myBookings()
    {
        $user = Auth::user();

        $bookings = $user->bookings()->with(['trip', 'payment'])->latest()->paginate(100);

        return response()->json([
            'message' => 'Your bookings retrieved successfully.',
            'data' => $bookings,
        ]);
    }

    /**
     * Display a listing of bookings.
     */
    public function index()
    {
        // Return paginated bookings with relations
        $bookings = Booking::with(['user', 'trip', 'payment'])->paginate(10);

        return response()->json($bookings);
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'trip_id' => 'required|exists:trips,id',
            'seat_number' => 'required|max:10',
            'status' => 'required|string|in:pending,confirmed,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Merge the authenticated user's ID into the data
        $data = $validator->validated();
        $data['user_id'] = auth()->id(); // or $request->user()->id

        $booking = Booking::create($data);

        return response()->json($booking->load(['user', 'trip']), 201);



    }

    /**
     * Display the specified booking.
     */
    public function show($id)
    {
        $booking = Booking::with(['user', 'trip', 'payment'])->find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return response()->json($booking);
    }

    /**
     * Update the specified booking in storage.
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        // Validation rules
        $validator = Validator::make($request->all(), [
            'status' => 'sometimes|string|in:pending,confirmed,cancelled',
            'seat_number' => 'sometimes|max:10',
            'trip_id' => 'sometimes|exists:trips,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update booking fields
        $booking->update($request->only('status', 'seat_id', 'trip_id'));

        return response()->json($booking);
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $booking->delete();

        return response()->json(['message' => 'Booking deleted successfully']);
    }
}
