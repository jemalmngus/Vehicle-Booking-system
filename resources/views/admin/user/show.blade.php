@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">User Details</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Show</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">User #{{ $user->id }}</h3>
                            </div>

                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-sm-4">Name</dt>
                                    <dd class="col-sm-8">{{ $user->name }}</dd>

                                    <dt class="col-sm-4">Email</dt>
                                    <dd class="col-sm-8">{{ $user->email }}</dd>

                                    <dt class="col-sm-4">Role</dt>
                                    <dd class="col-sm-8"><span class="badge text-bg-secondary">{{ ucfirst($user->role) }}</span></dd>

                                    <dt class="col-sm-4">Created At</dt>
                                    <dd class="col-sm-8">{{ optional($user->created_at)->format('Y-m-d H:i') }}</dd>

                                    <dt class="col-sm-4">Updated At</dt>
                                    <dd class="col-sm-8">{{ optional($user->updated_at)->format('Y-m-d H:i') }}</dd>
                                </dl>
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary float-end">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection