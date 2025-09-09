@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Create Trip</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('trips.index') }}">Trips</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('trips.store') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Vehicle</label>
                                        <select name="vehicle_id" class="form-select" required>
                                            <option value="">Select vehicle</option>
                                            @foreach(\App\Models\Vehicle::with('type')->get() as $vehicle)
                                                <option value="{{ $vehicle->id }}" @selected(old('vehicle_id')==$vehicle->id)>
                                                    {{ $vehicle->name }} ({{ $vehicle->type->name ?? 'N/A' }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_id')<div class="text-danger small">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Route</label>
                                        <select name="route_id" class="form-select" required>
                                            <option value="">Select route</option>
                                            @foreach(\App\Models\Route::with(['startStation','endStation'])->get() as $route)
                                                <option value="{{ $route->id }}" @selected(old('route_id')==$route->id)>
                                                    {{ $route->startStation->name ?? 'N/A' }} → {{ $route->endStation->name ?? 'N/A' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('route_id')<div class="text-danger small">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Departure Time</label>
                                        <input type="datetime-local" name="departure_time" class="form-control" value="{{ old('departure_time') }}" required />
                                        @error('departure_time')<div class="text-danger small">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Arrival Time</label>
                                        <input type="datetime-local" name="arrival_time" class="form-control" value="{{ old('arrival_time') }}" required />
                                        @error('arrival_time')<div class="text-danger small">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="d-flex gap-2">
                                        <a href="{{ route('trips.index') }}" class="btn btn-secondary">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@extends('layouts.app')

@section('content')
@endsection
