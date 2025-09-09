<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <!-- Start Navbar Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            </li>
        </ul>

        <!-- End Navbar Links -->
        <ul class="navbar-nav ms-auto">

            <!-- Fullscreen Toggle -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
                </a>
            </li>

            <!-- User Menu -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset('adminlte/assets/img/user2-160x160.jpg') }}"
                        class="user-image rounded-circle shadow" alt="User Image" />
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <!-- User image -->
                    <li class="user-header text-bg-primary">
                        <img src="{{ asset('adminlte/assets/img/user2-160x160.jpg') }}" class="rounded-circle shadow"
                            alt="User Image" />

                        <p class="mb-0">
                            {{ Auth::user()->name }} - {{ ucfirst(Auth::user()->role ?? 'User') }}
                        </p>
                        <p class="mb-0">
                            <small>{{ Auth::user()->email }}</small>
                        </p>
                        <p class="mt-1">
                            <small>Member since {{ Auth::user()->created_at->format('M Y') }}</small>
                        </p>
                    </li>



                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profile</a>

                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-default btn-flat float-end">Sign out</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>