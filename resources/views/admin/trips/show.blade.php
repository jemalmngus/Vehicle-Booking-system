@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Trip Details</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('trips.index') }}">Trips</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Show</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title mb-0">Overview</h3>
                            </div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-sm-4">Vehicle</dt>
                                    <dd class="col-sm-8">{{ $trip->vehicle->name ?? 'N/A' }}</dd>

                                    <dt class="col-sm-4">Route</dt>
                                    <dd class="col-sm-8">
                                        {{ $trip->route->startStation->name ?? 'N/A' }} →
                                        {{ $trip->route->endStation->name ?? 'N/A' }}
                                    </dd>

                                    <dt class="col-sm-4">Departure</dt>
                                    <dd class="col-sm-8">
                                        {{ \Carbon\Carbon::parse($trip->departure_time)->format('Y-m-d H:i') }}</dd>

                                    <dt class="col-sm-4">Arrival</dt>
                                    <dd class="col-sm-8">
                                        {{ \Carbon\Carbon::parse($trip->arrival_time)->format('Y-m-d H:i') }}</dd>
                                </dl>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title mb-0">Bookings</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Seat</th>
                                            <th>Status</th>
                                            <th>Booked At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($trip->bookings as $booking)
                                            <tr>
                                                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                                <td>{{ $booking->seat_number }}</td>
                                                <td>{{ ucfirst($booking->status) }}</td>
                                                <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No bookings for this trip.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection