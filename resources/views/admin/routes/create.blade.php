@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Create Route</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('routes.index') }}">Routes</a></li>
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
                            <div class="card-header"><h3 class="card-title">New Route</h3></div>
                            <form action="{{ route('routes.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">From (Start Station)</label>
                                        <select name="start_station_id" class="form-select" required>
                                            <option value="">-- Select Station --</option>
                                            @foreach($stations as $station)
                                                <option value="{{ $station->id }}" @selected(old('start_station_id')==$station->id)>{{ $station->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('start_station_id')<div class="text-danger small">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">To (End Station)</label>
                                        <select name="end_station_id" class="form-select" required>
                                            <option value="">-- Select Station --</option>
                                            @foreach($stations as $station)
                                                <option value="{{ $station->id }}" @selected(old('end_station_id')==$station->id)>{{ $station->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('end_station_id')<div class="text-danger small">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Distance (km)</label>
                                        <input type="number" step="0.1" min="0" name="distance_km" class="form-control" value="{{ old('distance_km') }}" required>
                                        @error('distance_km')<div class="text-danger small">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
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
