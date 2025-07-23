@extends('layouts.admin_layout')

@section('content')
    <div class="dashboard-body">

        <!-- Breadcrumb & Actions -->
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('dashboard.index') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Add Booking</span></li>
                </ul>
            </div>

            <div class="flex-align justify-content-end gap-8">
                <a href="{{ route('bookings.index') }}"
                    class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</a>
                <button type="submit" form="addBookingForm" class="btn btn-main rounded-pill py-9">Save Booking</button>
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
                <form id="addBookingForm" action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <div class="row g-20">

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Guest</label>
                            <select name="guest_id" class="form-select" required>
                                <option disabled selected>Select Guest</option>
                                @foreach ($guests as $guest)
                                    <option value="{{ $guest->id }}">{{ $guest->full_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Room</label>
                            <select name="room_id" class="form-select" required>
                                <option disabled selected>Select Room</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Booking Type</label>
                            <select name="booking_type" class="form-select" required>
                                <option disabled selected>Select Type</option>
                                <option value="walk-in">Walk-in</option>
                                <option value="online">Online</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Check In</label>
                            <input type="datetime-local" name="check_in" class="form-control" required>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Check Out</label>
                            <input type="datetime-local" name="check_out" class="form-control" required>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="booked">Booked</option>
                                <option value="checked_in">Checked In</option>
                                <option value="checked_out">Checked Out</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>



                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Booking Reference</label>
                            <input type="text" name="booking_reference" class="form-control"
                                placeholder="Auto or manual">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Payment Status</label>
                            <select name="payment_status" class="form-select" required>
                                <option value="unpaid">Unpaid</option>
                                <option value="partial">Partial</option>
                                <option value="paid">Paid</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Total Amount</label>
                            <input type="number" step="0.01" name="total_amount" class="form-control"
                                placeholder="Total PKR">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Discount</label>
                            <input type="number" step="0.01" name="discount" class="form-control"
                                placeholder="Discount amount">
                        </div>

                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Payment Method</label>
                            <select name="payment_method" class="form-select" required>
                                <option disabled selected>Select Payment Method</option>
                                <option value="cash">Cash</option>
                                <option value="card">Card</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="easypaisa">EasyPaisa</option>
                                <option value="jazzcash">JazzCash</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Active</label>
                            <select name="is_active" class="form-select" required>
                                <option value="1" selected>Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Notes</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Additional info"></textarea>
                        </div>

                        <div class="col-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Cancellation Reason</label>
                            <input type="text" name="cancellation_reason" class="form-control"
                                placeholder="If cancelled">
                        </div>




                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex-align justify-content-end gap-8 mt-24">
                        <a href="{{ route('bookings.index') }}" class="btn btn-outline-main rounded-pill py-9">Cancel</a>
                        <button type="submit" class="btn btn-main rounded-pill py-9">Create Booking</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
