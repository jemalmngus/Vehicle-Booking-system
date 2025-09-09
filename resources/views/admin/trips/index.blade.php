@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Trips</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Trips</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @include('components.alerts')

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Trip Table</h3>
                                <a href="{{ route('trips.create') }}" class="btn btn-sm btn-primary">Create Trip</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Vehicle</th>
                                            <th>Route</th>
                                            <th>Departure</th>
                                            <th>Arrival</th>
                                            <th style="width: 150px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($trips as $index => $trip)
                                            <tr class="align-middle">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $trip->vehicle->name ?? 'N/A' }}</td>
                                                <td>
                                                    {{ $trip->route->startStation->name ?? 'N/A' }} →
                                                    {{ $trip->route->endStation->name ?? 'N/A' }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($trip->departure_time)->format('Y-m-d H:i') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($trip->arrival_time)->format('Y-m-d H:i') }}</td>

                                                <td>
                                                    <a href="{{ route('trips.show', $trip->id) }}" class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('trips.edit', $trip->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('trips.destroy', $trip->id) }}" method="POST"
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
                                                <td colspan="6" class="text-center">No trips found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                {{ $trips->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection