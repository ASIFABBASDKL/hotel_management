@extends('layouts.admin_layout')

@section('content')
<div class="dashboard-body">

    <!-- Breadcrumb -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('dashboard.index') }}" class="text-gray-200 text-15 hover-text-main-600">Home</a></li>
                <li><span class="text-gray-500"><i class="ph ph-caret-right"></i></span></li>
                <li><a href="{{ route('payments.index') }}" class="text-gray-200 text-15 hover-text-main-600">Payments</a></li>
                <li><span class="text-gray-500"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 text-15">Add Payment</span></li>
            </ul>
        </div>

        <div class="flex-align justify-content-end gap-8">
            <a href="{{ route('payments.index') }}" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</a>
            <button type="submit" form="addPaymentForm" class="btn btn-main rounded-pill py-9">Save Payment</button>
        </div>
    </div>

    <!-- Step -->
    <ul class="step-list mb-24">
        <li class="step-list__item py-15 px-24 text-15 text-heading fw-medium flex-center gap-6 active">
            <span class="icon text-xl d-flex"><i class="ph ph-circle"></i></span>
            Payment Details
            <span class="line position-relative"></span>
        </li>
    </ul>

    <!-- Payment Form -->
    <div class="card">
        <div class="card-header border-bottom border-gray-100 flex-align gap-8">
            <h5 class="mb-0">Payment Information</h5>
        </div>

        <div class="card-body">
            <form id="addPaymentForm" action="{{ route('payments.store') }}" method="POST">
                @csrf
                <div class="row g-20">

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Booking</label>
                        <select name="booking_id" class="form-select" required>
                            <option disabled selected>Select Booking</option>
                            @foreach ($bookings as $booking)
                                <option value="{{ $booking->id }}">
                                    #{{ $booking->id }} - {{ $booking->guest->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Payment Method</label>
                        <select name="payment_method" class="form-select" required>
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="online">Online</option>
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Amount Paid</label>
                        <input type="number" step="0.01" name="amount_paid" class="form-control" required>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Due Amount</label>
                        <input type="number" step="0.01" name="due_amount" class="form-control">
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Refund Amount</label>
                        <input type="number" step="0.01" name="refund_amount" class="form-control">
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Payment Date</label>
                        <input type="datetime-local" name="payment_date" class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="h5 mb-8 fw-semibold font-heading">Transaction Reference</label>
                        <input type="text" name="transaction_reference" class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="h5 mb-8 fw-semibold font-heading">Note</label>
                        <textarea name="note" class="form-control" rows="3" placeholder="Optional notes about this payment"></textarea>
                    </div>

                </div>

                <!-- Footer Buttons -->
                <div class="flex-align justify-content-end gap-8 mt-24">
                    <a href="{{ route('payments.index') }}" class="btn btn-outline-main rounded-pill py-9">Cancel</a>
                    <button type="submit" class="btn btn-main rounded-pill py-9">Add Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
