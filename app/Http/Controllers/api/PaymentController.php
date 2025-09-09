<?php

namespace App\Http\Controllers\API;

use App\Models\Payment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PaymentController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('booking.user')->paginate(10);
        return response()->json($payments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:50',
            'status' => 'required|in:pending,completed,failed',
        ]);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);
        $payment = Payment::create($validator->validated());
        return response()->json($payment->load('booking.user'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $payment = Payment::with('booking.user')->find($id);
        if (!$payment) return response()->json(['message' => 'Not found'], 404);
        return response()->json($payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        if (!$payment) return response()->json(['message' => 'Not found'], 404);
        $validator = Validator::make($request->all(), [
            'booking_id' => 'sometimes|exists:bookings,id',
            'amount' => 'sometimes|numeric|min:0',
            'payment_method' => 'sometimes|string|max:50',
            'status' => 'sometimes|in:pending,completed,failed',
        ]);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);
        $payment->update($validator->validated());
        return response()->json($payment->load('booking.user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);
        if (!$payment) return response()->json(['message' => 'Not found'], 404);
        $payment->delete();
        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
