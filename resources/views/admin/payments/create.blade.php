@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Create Payment</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('payments.index') }}">Payments</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @include('components.alerts')
        <div class="app-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card card-primary card-outline">
                            <div class="card-header"><h3 class="card-title">New Payment</h3></div>
                            <form action="{{ route('payments.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Booking</label>
                                        <select name="booking_id" class="form-select" required>
                                            <option value="">-- Select Booking --</option>
                                            @foreach($bookings as $booking)
                                                <option value="{{ $booking->id }}" @selected(old('booking_id')==$booking->id)>
                                                    #{{ $booking->id }} - {{ $booking->user->name ?? 'N/A' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Amount</label>
                                        <input type="number" step="0.01" min="0" name="amount" class="form-control" value="{{ old('amount') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Payment Method</label>
                                        <input type="text" name="payment_method" class="form-control" value="{{ old('payment_method') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select" required>
                                            @foreach(['pending','completed','failed'] as $status)
                                                <option value="{{ $status }}" @selected(old('status')==$status)>{{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    <a href="{{ route('payments.index') }}" class="btn btn-secondary float-end">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
