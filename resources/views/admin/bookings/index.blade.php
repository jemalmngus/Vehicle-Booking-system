@extends('layouts.app')

@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Bookings</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Bookings</li>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Booking Table</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>User</th>
                                            <th>Trip</th>
                                            <th>Seat</th>
                                            <th>Status</th>
                                            <th>Booked At</th>
                                            <th style="width: 150px;">Actions</th> <!-- ✅ New column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($bookings as $index => $booking)
                                            <tr class="align-middle">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                                <td>{{ $booking->trip_id ?? 'N/A' }}</td>
                                                <td>{{ $booking->seat_number ?? 'N/A' }}</td>
                                                <td>
                                                    @php
                                                        $status = strtolower($booking->status);
                                                        $badgeClass = match ($status) {
                                                            'confirmed' => 'success',
                                                            'cancelled' => 'danger',
                                                            'pending' => 'warning',
                                                            default => 'secondary',
                                                        };
                                                    @endphp
                                                    <span class="badge text-bg-{{ $badgeClass }}">
                                                        {{ ucfirst($status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $booking->created_at->format('Y-m-d') }}</td>

                                                <!-- ✅ Action Buttons -->
                                                <td>
                                                    <a href="{{ route('bookings.show', $booking->id) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('bookings.edit', $booking->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                                        class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No bookings found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                {{ $bookings->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection