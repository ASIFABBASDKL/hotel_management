@extends('layouts.admin_layout')

@section('content')
    <div class="dashboard-body">

        <!-- Breadcrumb & Actions -->
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('dashboard.index') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Edit Booking</span></li>
                </ul>
            </div>

            <div class="flex-align justify-content-end gap-8">
                <a href="{{ route('bookings.index') }}" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</a>
                <button type="submit" form="editBookingForm" class="btn btn-main rounded-pill py-9">Update Booking</button>
            </div>
        </div>

        <!-- Step List -->
        <ul class="step-list mb-24">
            <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6 active">
                <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span>
                Booking Details
                <span class="line position-relative"></span>
            </li>
        </ul>

        <!-- Booking Form Card -->
        <div class="card">
            <div class="card-header border-bottom border-gray-100 flex-align gap-8">
                <h5 class="mb-0">Booking Information</h5>
            </div>

            <div class="card-body">
                <form id="editBookingForm" action="{{ route('bookings.update', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-20">
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Guest</label>
                            <select name="guest_id" class="form-select" required>
                                <option disabled>Select Guest</option>
                                @foreach ($guests as $guest)
                                    <option value="{{ $guest->id }}" {{ $guest->id == $booking->guest_id ? 'selected' : '' }}>{{ $guest->full_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Room</label>
                            <select name="room_id" class="form-select" required>
                                <option disabled>Select Room</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}" {{ $room->id == $booking->room_id ? 'selected' : '' }}>{{ $room->room_number }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Booking Type</label>
                            <select name="booking_type" class="form-select" required>
                                <option value="walk-in" {{ $booking->booking_type == 'walk-in' ? 'selected' : '' }}>Walk-in</option>
                                <option value="online" {{ $booking->booking_type == 'online' ? 'selected' : '' }}>Online</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Check In</label>
                            <input type="datetime-local" name="check_in" class="form-control" value="{{ \Illuminate\Support\Carbon::parse($booking->check_in)->format('Y-m-d\TH:i') }}" required>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Check Out</label>
                            <input type="datetime-local" name="check_out" class="form-control" value="{{ \Illuminate\Support\Carbon::parse($booking->check_out)->format('Y-m-d\TH:i') }}" required>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="booked" {{ $booking->status == 'booked' ? 'selected' : '' }}>Booked</option>
                                <option value="checked_in" {{ $booking->status == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                                <option value="checked_out" {{ $booking->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Booking Reference</label>
                            <input type="text" name="booking_reference" class="form-control" value="{{ $booking->booking_reference }}">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Payment Status</label>
                            <select name="payment_status" class="form-select" required>
                                <option value="unpaid" {{ $booking->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="partial" {{ $booking->payment_status == 'partial' ? 'selected' : '' }}>Partial</option>
                                <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Total Amount</label>
                            <input type="number" step="0.01" name="total_amount" class="form-control" value="{{ $booking->total_amount }}">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Discount</label>
                            <input type="number" step="0.01" name="discount" class="form-control" value="{{ $booking->discount }}">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Payment Method</label>
                            <select name="payment_method" class="form-select" required>
                                <option disabled>Select Payment Method</option>
                                <option value="cash" {{ $booking->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="card" {{ $booking->payment_method == 'card' ? 'selected' : '' }}>Card</option>
                                <option value="bank_transfer" {{ $booking->payment_method == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="easypaisa" {{ $booking->payment_method == 'easypaisa' ? 'selected' : '' }}>EasyPaisa</option>
                                <option value="jazzcash" {{ $booking->payment_method == 'jazzcash' ? 'selected' : '' }}>JazzCash</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Active</label>
                            <select name="is_active" class="form-select" required>
                                <option value="1" {{ $booking->is_active ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$booking->is_active ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Notes</label>
                            <textarea name="notes" class="form-control" rows="3">{{ $booking->notes }}</textarea>
                        </div>

                        <div class="col-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Cancellation Reason</label>
                            <input type="text" name="cancellation_reason" class="form-control" value="{{ $booking->cancellation_reason }}">
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex-align justify-content-end gap-8 mt-24">
                        <a href="{{ route('bookings.index') }}" class="btn btn-outline-main rounded-pill py-9">Cancel</a>
                        <button type="submit" class="btn btn-main rounded-pill py-9">Update Booking</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
