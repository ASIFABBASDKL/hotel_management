@extends('layouts.admin_layout')

@section('content')
    <div class="dashboard-body">

        <!-- Breadcrumb -->
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="#" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Booking Management</span></li>
                </ul>
            </div>
            <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-sm">Add Booking</a>
        </div>

        <!-- Booking List Table -->
        <div class="card p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="h6 text-gray-300">#</th>
                        <th class="h6 text-gray-300">Guest</th>
                        <th class="h6 text-gray-300">Room</th>
                        <th class="h6 text-gray-300">Check In</th>
                        <th class="h6 text-gray-300">Check Out</th>
                        <th class="h6 text-gray-300">Status</th>
                        <th class="h6 text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $key => $booking)
                        <tr>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $key + 1 }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $booking->guest->full_name ?? '-' }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $booking->room->room_number ?? '-' }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $booking->check_in }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $booking->check_out }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ ucfirst($booking->status) }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300 d-flex gap-2">
                                <a href="{{ route('bookings.show', $booking->id) }}"
                                    class="bg-main-50 text-green-600 py-2 px-14 rounded-pill hover-bg-green-600 hover-text-white">
                                    View
                                </a>
                                <a href="{{ route('bookings.edit', $booking->id) }}"
                                    class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">
                                    Edit
                                </a>
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
