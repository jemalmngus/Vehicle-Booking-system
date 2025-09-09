@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Notifications</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Notifications</li>
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
                                <h3 class="card-title mb-0">Notification Table</h3>
                                <a href="{{ route('notifications.create') }}" class="btn btn-sm btn-primary">Create Notification</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>User</th>
                                            <th>Title</th>
                                            <th>Read</th>
                                            <th style="width: 150px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($notifications as $index => $notification)
                                            <tr class="align-middle">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $notification->user->name ?? 'N/A' }}</td>
                                                <td>{{ $notification->title }}</td>
                                                <td>
                                                    @if($notification->is_read)
                                                        <span class="badge text-bg-success">Read</span>
                                                    @else
                                                        <span class="badge text-bg-warning">Unread</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('notifications.show', $notification->id) }}" class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('notifications.edit', $notification->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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
                                                <td colspan="5" class="text-center">No notifications found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                {{ $notifications->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
