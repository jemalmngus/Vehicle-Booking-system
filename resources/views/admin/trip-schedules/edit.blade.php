@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Edit Trip Schedule</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('trip-schedules.index') }}">Trip Schedules</a></li>
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
                            <div class="card-header"><h3 class="card-title">Schedule Form</h3></div>
                            <form action="{{ route('trip-schedules.update', $tripSchedule->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Route</label>
                                        <select name="route_id" class="form-select" required>
                                            @foreach($routes as $route)
                                                <option value="{{ $route->id }}" @selected(old('route_id', $tripSchedule->route_id)==$route->id)>
                                                    {{ $route->startStation->name ?? 'N/A' }} → {{ $route->endStation->name ?? 'N/A' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Vehicle</label>
                                        <select name="vehicle_id" class="form-select" required>
                                            @foreach($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}" @selected(old('vehicle_id', $tripSchedule->vehicle_id)==$vehicle->id)>{{ $vehicle->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Trip Date</label>
                                        <input type="date" name="trip_date" class="form-control" value="{{ old('trip_date', \Carbon\Carbon::parse($tripSchedule->trip_date)->format('Y-m-d')) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Departure Time</label>
                                        <input type="time" name="departure_time" class="form-control" value="{{ old('departure_time', $tripSchedule->departure_time) }}" required>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('trip-schedules.index') }}" class="btn btn-secondary float-end">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
