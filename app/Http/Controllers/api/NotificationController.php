<?php

namespace App\Http\Controllers\API;

use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class NotificationController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::with('user')->paginate(10);
        return response()->json($notifications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'is_read' => 'sometimes|boolean',
        ]);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);
        $notification = Notification::create($validator->validated());
        return response()->json($notification->load('user'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $notification = Notification::with('user')->find($id);
        if (!$notification) return response()->json(['message' => 'Not found'], 404);
        return response()->json($notification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);
        if (!$notification) return response()->json(['message' => 'Not found'], 404);
        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id',
            'title' => 'sometimes|string|max:255',
            'message' => 'sometimes|string',
            'is_read' => 'sometimes|boolean',
        ]);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);
        $notification->update($validator->validated());
        return response()->json($notification->load('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notification = Notification::find($id);
        if (!$notification) return response()->json(['message' => 'Not found'], 404);
        $notification->delete();
        return response()->json(['message' => 'Notification deleted successfully']);
    }
}
