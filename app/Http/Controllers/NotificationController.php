<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::with('user')->paginate(100);

        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();

        return view('admin.notifications.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'is_read' => 'sometimes|boolean',
        ]);

        Notification::create($validated);

        return redirect()->route('notifications.index')->with('success', 'Notification created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        $notification->load('user');

        return view('admin.notifications.show', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'is_read' => 'sometimes|boolean',
        ]);

        $notification->update($validated);

        return redirect()->route('notifications.index')->with('success', 'Notification updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        $users = User::all();

        return view('admin.notifications.edit', compact('notification', 'users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully.');
    }
}
