<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <!-- <img src="./assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" /> -->
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Vehicle Booking System</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                            <!-- <i class="nav-arrow bi bi-chevron-right"></i> -->
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/dashboard" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Admin Dashboard</p>
                            </a>
                        </li>
                    </ul> -->
                </li>
                <!-- #users  -->
                <!-- Users / Passengers -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>
                            Users
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/users" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/users/create" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Add User</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- end of users -->

                <!-- Vehicles -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-truck-front-fill"></i>
                        <p>
                            Vehicles
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/vehicles" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View Vehicles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/vehicles/create" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Add Vehicle</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Vehicle Types -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-car-front-fill"></i>
                        <p>
                            Vehicle Types
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/vehicle-types" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View Types</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/vehicle-types/create" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Add Type</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Stations -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-geo-alt-fill"></i>
                        <p>
                            Stations
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/stations" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View Stations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/stations/create" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Add Station</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Routes -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-signpost-2-fill"></i>
                        <p>
                            Routes
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/routes" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View Routes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/routes/create" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Add Route</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Trips -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-calendar2-week-fill"></i>
                        <p>
                            Trips
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/trips" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View Trips</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/trips/create" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Add Trip</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Trip Schedules -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-clock-history"></i>
                        <p>
                            Trip Schedules
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/trip-schedules" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View Schedules</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/trip-schedules/create" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Add Schedule</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Seats -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-grid-3x3-gap-fill"></i>
                        <p>
                            Seats
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/seats" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View Seats</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/seats/create" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Add Seat</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Bookings -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-journal-bookmark-fill"></i>
                        <p>
                            Bookings
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/bookings" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View Bookings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/bookings/create" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Add Booking</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Payments -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-credit-card-fill"></i>
                        <p>
                            Payments
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/payments" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View Payments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/payments/create" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Add Payment</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Notifications -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-bell-fill"></i>
                        <p>
                            Notifications
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/notifications" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View Notifications</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/notifications/create" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Add Notification</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>

    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->