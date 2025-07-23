@extends('layouts.admin_layout')

@section('content')
<div class="dashboard-body">

    <!-- Breadcrumb & Actions -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('dashboard.index') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><a href="{{ route('rooms.index') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Room Management</a></li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 fw-normal text-15">Edit Room</span></li>
            </ul>
        </div>

        <div class="flex-align justify-content-end gap-8">
            <a href="{{ route('rooms.index') }}" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</a>
            <button type="submit" form="editRoomForm" class="btn btn-main rounded-pill py-9">Update Room</button>
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

    <!-- Room Form Card -->
    <div class="card">
        <div class="card-header border-bottom border-gray-100 flex-align gap-8">
            <h5 class="mb-0">Edit Room</h5>
        </div>

        <div class="card-body">
            <form id="editRoomForm" action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-20">
                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Room Number</label>
                        <input type="text" name="room_number" class="form-control" value="{{ old('room_number', $room->room_number) }}" required>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Floor Number</label>
                        <input type="number" name="floor_number" class="form-control" value="{{ old('floor_number', $room->floor_number) }}">
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Room Type</label>
                        <select name="type" class="form-select py-9 placeholder-13 text-15" required>
                            <option value="Single" {{ $room->type === 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Deluxe" {{ $room->type === 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                            <option value="Suite" {{ $room->type === 'Suite' ? 'selected' : '' }}>Suite</option>
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Price (PKR)</label>
                        <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price', $room->price) }}" required>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Occupancy Limit</label>
                        <input type="number" name="occupancy_limit" class="form-control" value="{{ old('occupancy_limit', $room->occupancy_limit) }}" required>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Status</label>
                        <select name="status" class="form-select py-9 placeholder-13 text-15" required>
                            <option value="available" {{ $room->status === 'available' ? 'selected' : '' }}>Available</option>
                            <option value="occupied" {{ $room->status === 'occupied' ? 'selected' : '' }}>Occupied</option>
                            <option value="maintenance" {{ $room->status === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Amenities</label>
                        <input type="text" name="amenities" class="form-control" value="{{ old('amenities', is_array($room->amenities) ? implode(', ', $room->amenities) : $room->amenities) }}">
                        <small class="text-gray-400">Comma-separated list</small>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Room Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        @if($room->image)
                            <small class="d-block mt-2">Current: <img src="{{ asset('storage/' . $room->image) }}" alt="Room Image" width="60"></small>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
