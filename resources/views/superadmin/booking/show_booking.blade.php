@extends('layouts.admin_layout')

@section('content')
<div class="dashboard-body">

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('dashboard.index') }}"
                       class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><a href="{{ route('bookings.index') }}"
                       class="text-gray-200 fw-normal text-15 hover-text-main-600">Bookings</a></li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 fw-normal text-15">Booking Details</span></li>
            </ul>
        </div>
    </div>

    <div class="card p-4">
        <h5 class="mb-4"><i class="ph ph-calendar-check text-main-600 me-2"></i>Booking Information</h5>

        <div class="row g-20 text-gray-200">

            <div class="col-sm-6"><i class="ph ph-user me-2"></i><strong>Guest:</strong> {{ $booking->guest->full_name }}</div>
            <div class="col-sm-6"><i class="ph ph-bed me-2"></i><strong>Room:</strong> {{ $booking->room->room_number }}</div>
            <div class="col-sm-6"><i class="ph ph-calendar-plus me-2"></i><strong>Booking Type:</strong> {{ ucfirst($booking->booking_type) }}</div>
            <div class="col-sm-6"><i class="ph ph-info me-2"></i><strong>Status:</strong> {{ ucfirst($booking->status) }}</div>
            <div class="col-sm-6"><i class="ph ph-clock me-2"></i><strong>Check In:</strong> {{ $booking->check_in }}</div>
            <div class="col-sm-6"><i class="ph ph-clock me-2"></i><strong>Check Out:</strong> {{ $booking->check_out }}</div>
            <div class="col-sm-6"><i class="ph ph-hash me-2"></i><strong>Reference:</strong> {{ $booking->booking_reference }}</div>
            <div class="col-sm-6"><i class="ph ph-credit-card me-2"></i><strong>Payment Method:</strong> {{ ucfirst($booking->payment_method) }}</div>
            <div class="col-sm-6"><i class="ph ph-currency-circle-dollar me-2"></i><strong>Payment Status:</strong> {{ ucfirst($booking->payment_status) }}</div>
            <div class="col-sm-6"><i class="ph ph-wallet me-2"></i><strong>Total Amount:</strong> Rs. {{ $booking->total_amount }}</div>
            <div class="col-sm-6"><i class="ph ph-percent me-2"></i><strong>Discount:</strong> Rs. {{ $booking->discount }}</div>
            <div class="col-sm-6"><i class="ph ph-check-circle me-2"></i><strong>Is Active:</strong> {{ $booking->is_active ? 'Yes' : 'No' }}</div>
            <div class="col-12"><i class="ph ph-note me-2"></i><strong>Notes:</strong><br> {{ $booking->notes ?? 'N/A' }}</div>
            <div class="col-12"><i class="ph ph-x-circle me-2"></i><strong>Cancellation Reason:</strong><br> {{ $booking->cancellation_reason ?? 'N/A' }}</div>

        </div>

        <div class="mt-4">
            <a href="{{ route('bookings.index') }}" class="btn btn-outline-main rounded-pill py-9">← Back</a>
        </div>
    </div>
</div>
@endsection
