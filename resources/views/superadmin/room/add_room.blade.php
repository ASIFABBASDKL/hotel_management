@extends('layouts.admin_layout')

@section('content')
<div class="dashboard-body">

    <!-- Breadcrumb -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('dashboard.index') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li><span class="text-gray-500 fw-normal"><i class="ph ph-caret-right"></i></span></li>
                <li><a href="{{ route('rooms.index') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Room Management</a></li>
                <li><span class="text-gray-500 fw-normal"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 fw-normal text-15">Add Room</span></li>
            </ul>
        </div>
    </div>

    <!-- Step Indicator -->
    <ul class="step-list mb-24">
        <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6 active">
            <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span>
            Room Details
            <span class="line position-relative"></span>
        </li>
    </ul>

    <!-- Form Card -->
    <div class="card">
        <div class="card-header border-bottom border-gray-100 flex-align gap-8">
            <h5 class="mb-0">Room Details</h5>
        </div>

        <div class="card-body">
            <form id="addRoomForm" action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-20">
                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Room Number</label>
                        <input type="text" name="room_number" class="form-control" placeholder="Enter room number" required>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Floor Number</label>
                        <input type="number" name="floor_number" class="form-control" placeholder="Enter floor number">
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Room Type</label>
                        <select name="type" class="form-select py-9 placeholder-13 text-15" required>
                            <option disabled selected>Select room type</option>
                            <option value="Single">Single</option>
                            <option value="Deluxe">Deluxe</option>
                            <option value="Suite">Suite</option>
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Price (PKR)</label>
                        <input type="number" step="0.01" name="price" class="form-control" placeholder="Enter price" required>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Occupancy Limit</label>
                        <input type="number" name="occupancy_limit" class="form-control" placeholder="Max people" required>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Status</label>
                        <select name="status" class="form-select py-9 placeholder-13 text-15" required>
                            <option disabled selected>Select status</option>
                            <option value="available">Available</option>
                            <option value="occupied">Occupied</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Amenities</label>
                        <input type="text" name="amenities" class="form-control" placeholder="e.g. WiFi, TV, AC">
                        <small class="text-gray-400">Separate amenities with commas (e.g., WiFi, TV, AC)</small>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Room Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="flex-align justify-content-end gap-8 mt-20">
                    <a href="{{ route('rooms.index') }}" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</a>
                    <button type="submit" class="btn btn-main rounded-pill py-9">Save Room</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
