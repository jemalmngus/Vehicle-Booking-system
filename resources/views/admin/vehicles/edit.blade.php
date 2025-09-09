@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Edit Vehicle</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('vehicles.index') }}">Vehicles</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                            <div class="card-header"><h3 class="card-title">Vehicle Form</h3></div>
                            <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $vehicle->name) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Plate Number</label>
                                        <input type="text" name="plate_number" class="form-control" value="{{ old('plate_number', $vehicle->plate_number) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Total Seats</label>
                                        <input type="number" name="total_seats" min="1" class="form-control" value="{{ old('total_seats', $vehicle->total_seats) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Vehicle Type</label>
                                        <select name="vehicle_type_id" class="form-select" required>
                                            @foreach($vehicleTypes as $type)
                                                <option value="{{ $type->id }}" @selected(old('vehicle_type_id', $vehicle->vehicle_type_id)==$type->id)>{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Image URL</label>
                                        <input type="text" name="image" class="form-control" value="{{ old('image', $vehicle->image) }}">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary float-end">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
