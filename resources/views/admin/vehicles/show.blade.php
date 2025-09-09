@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Vehicle Details</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('vehicles.index') }}">Vehicles</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Show</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-outline card-primary">
                            <div class="card-header"><h3 class="card-title">Vehicle #{{ $vehicle->id }}</h3></div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-sm-4">Name</dt>
                                    <dd class="col-sm-8">{{ $vehicle->name }}</dd>
                                    <dt class="col-sm-4">Plate Number</dt>
                                    <dd class="col-sm-8">{{ $vehicle->plate_number }}</dd>
                                    <dt class="col-sm-4">Type</dt>
                                    <dd class="col-sm-8">{{ $vehicle->type->name ?? 'N/A' }}</dd>
                                    <dt class="col-sm-4">Total Seats</dt>
                                    <dd class="col-sm-8">{{ $vehicle->total_seats }}</dd>
                                </dl>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Back</a>
                                <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-primary float-end">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
