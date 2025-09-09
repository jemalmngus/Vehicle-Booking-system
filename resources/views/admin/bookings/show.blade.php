@extends('layouts.app')

@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Booking Details</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('bookings.index') }}">Bookings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Show</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Booking #{{ $booking->id }}</h3>
                            </div>

                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-sm-4">User</dt>
                                    <dd class="col-sm-8">{{ $booking->user->name ?? 'N/A' }}</dd>

                                    <dt class="col-sm-4">Trip</dt>
                                    <dd class="col-sm-8">{{ $booking->trip->name ?? $booking->trip->id ?? 'N/A' }}</dd>

                                    <dt class="col-sm-4">Seat Number</dt>
                                    <dd class="col-sm-8">{{ $booking->seat_number }}</dd>

                                    <dt class="col-sm-4">Status</dt>
                                    <dd class="col-sm-8">
                                        @php
                                            $badgeClass = match (strtolower($booking->status)) {
                                                'confirmed' => 'success',
                                                'pending' => 'warning',
                                                'cancelled' => 'danger',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $badgeClass }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </dd>

                                    <dt class="col-sm-4">Created At</dt>
                                    <dd class="col-sm-8">{{ $booking->created_at->format('Y-m-d H:i') }}</dd>

                                    <dt class="col-sm-4">Updated At</dt>
                                    <dd class="col-sm-8">{{ $booking->updated_at->format('Y-m-d H:i') }}</dd>
                                </dl>
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Back</a>
                                <a href="{{ route('bookings.edit', $booking) }}" class="btn btn-primary float-end">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection