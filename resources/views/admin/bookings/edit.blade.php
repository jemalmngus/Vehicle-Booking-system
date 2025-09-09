@extends('layouts.app')

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Booking</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('bookings.index') }}">Bookings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    @include('components.alerts')

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <!--begin::Card-->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Edit Booking</h3>
                        </div>

                        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <!-- User -->
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">User</label>
                                    <select name="user_id" id="user_id" class="form-select" required>
                                        <option value="">-- Select User --</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ (old('user_id', $booking->user_id) == $user->id) ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Trip -->
                                <div class="mb-3">
                                    <label for="trip_id" class="form-label">Trip</label>
                                    <select name="trip_id" id="trip_id" class="form-select" required>
                                        <option value="">-- Select Trip --</option>
                                        @foreach($trips as $trip)
                                            <option value="{{ $trip->id }}"
                                                {{ (old('trip_id', $booking->trip_id) == $trip->id) ? 'selected' : '' }}>
                                                {{ $trip->id }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Seat Number -->
                                <div class="mb-3">
                                    <label for="seat_number" class="form-label">Seat Number</label>
                                    <input type="number" name="seat_number" class="form-control" min="1" step="1"
                                        value="{{ old('seat_number', $booking->seat_number) }}" required>
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Booking</button>
                                <a href="{{ route('bookings.index') }}" class="btn btn-secondary float-end">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
