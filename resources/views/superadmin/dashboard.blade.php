@extends('layouts.admin_layout')
@section('content')
    {{-- <div class="dashboard-main-wrapper"> --}}

    <div class="dashboard-body">

        <div class="row gy-4">
            <div class="col-lg-9">
                <!-- Widgets Start -->
                <div class="row gy-4">
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <span class="text-gray-600">Total Rooms</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl">
                                        <i class="ph-fill ph-house"></i>
                                    </span>
                                    <div class="rounded-tooltip-value">
                                        <h3 class="text-dark fw-bold">{{ $totalRooms }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <span class="text-gray-600">Total Guests</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-warning text-white text-2xl">
                                        <i class="ph ph-user"></i>
                                    </span>
                                    <div class="rounded-tooltip-value">
                                        <h3 class="text-dark fw-bold">{{ $totalGuests }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <span class="text-gray-600">Total Bookings</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-info text-white text-2xl">
                                        <i class="ph ph-calendar-check"></i>
                                    </span>
                                    <div class="rounded-tooltip-value">
                                        <h3 class="text-dark fw-bold">{{ $totalBookings }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- Displaying completed orders count -->
                                <span class="text-gray-600">Orders Completed</span>
                                <div class="flex-between gap-8 mt-16">
                                    <span
                                        class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-warning-600 text-white text-2xl"><i
                                            class="ph ph-clipboard-text"></i></span>
                                    <div id="community-support" class="remove-tooltip-title rounded-tooltip-value">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Widgets End -->

                <!-- Widgets End -->

                <!-- Button Container Start -->
                <div class="container">
                    <div class="card p-4 shadow-sm mt-4"> <!-- This line changed -->
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('roles.create') }}" class="btn btn-primary flex-fill">
                                <i class="ph ph-user-plus me-1"></i> Add Role
                            </a>
                            <a href="{{ route('rooms.create') }}" class="btn btn-success flex-fill">
                                <i class="ph ph-house-line me-1"></i> Add Room
                            </a>
                            <a href="{{ route('bookings.create') }}" class="btn btn-info flex-fill">
                                <i class="ph ph-calendar-plus me-1"></i> Add Booking
                            </a>
                            <a href="{{ route('superadmin.guests.create') }}" class="btn btn-warning flex-fill">
                                <i class="ph ph-user-circle-plus me-1"></i> Add Guest
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Button Container End -->







            </div>




            <div class="col-lg-3">
                <!-- Calendar Start -->
                <div class="card">
                    <div class="card-body">
                        <div class="calendar">
                            <div class="calendar__header">
                                <button type="button" class="calendar__arrow left"><i
                                        class="ph ph-caret-left"></i></button>
                                <p class="display h6 mb-0">""</p>
                                <button type="button" class="calendar__arrow right"><i
                                        class="ph ph-caret-right"></i></button>
                            </div>

                            <div class="calendar__week week">
                                <div class="calendar__week-text">Su</div>
                                <div class="calendar__week-text">Mo</div>
                                <div class="calendar__week-text">Tu</div>
                                <div class="calendar__week-text">We</div>
                                <div class="calendar__week-text">Th</div>
                                <div class="calendar__week-text">Fr</div>
                                <div class="calendar__week-text">Sa</div>
                            </div>
                            <div class="days"></div>
                        </div>
                    </div>
                </div>
                <!-- Calendar End -->

            </div>

        </div>
    </div>

    {{-- </div> --}}
@endsection
