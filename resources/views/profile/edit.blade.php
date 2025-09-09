@extends('layouts.app')

@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Profile</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8">

                        {{-- Update Profile Information --}}
                        <div class="card card-outline card-primary mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Update Profile Information</h3>
                            </div>
                            <div class="card-body">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>

                        {{-- Update Password --}}
                        <div class="card card-outline card-warning mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Update Password</h3>
                            </div>
                            <div class="card-body">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>

                        {{-- Delete User --}}
                        <div class="card card-outline card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Delete Account</h3>
                            </div>
                            <div class="card-body">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection