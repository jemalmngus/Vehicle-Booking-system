@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Edit Route</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('routes.index') }}">Routes</a></li>
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
                            <div class="card-header"><h3 class="card-title">Route Form</h3></div>
                            <form action="{{ route('routes.update', $route->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">From (Start Station)</label>
                                        <select name="start_station_id" class="form-select" required>
                                            @foreach($stations as $station)
                                                <option value="{{ $station->id }}" @selected(old('start_station_id', $route->start_station_id)==$station->id)>{{ $station->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">To (End Station)</label>
                                        <select name="end_station_id" class="form-select" required>
                                            @foreach($stations as $station)
                                                <option value="{{ $station->id }}" @selected(old('end_station_id', $route->end_station_id)==$station->id)>{{ $station->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Distance (km)</label>
                                        <input type="number" step="0.1" min="0" name="distance_km" class="form-control" value="{{ old('distance_km', $route->distance_km) }}" required>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('routes.index') }}" class="btn btn-secondary float-end">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
