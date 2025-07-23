@extends('layouts.admin_layout')

@section('content')
<div class="dashboard-body">

    <!-- Breadcrumb -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('dashboard.index') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 fw-normal text-15">Payment Management</span></li>
            </ul>
        </div>

        <a href="{{ route('payments.create') }}" class="btn btn-primary btn-sm">Add Payment</a>
    </div>

    <!-- Payment List Table -->
    <div class="card p-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="h6 text-gray-300">#</th>
                    <th class="h6 text-gray-300">Booking ID</th>
                    <th class="h6 text-gray-300">Guest Name</th>
                    <th class="h6 text-gray-300">Method</th>
                    <th class="h6 text-gray-300">Amount</th>
                    <th class="h6 text-gray-300">Due</th>
                    <th class="h6 text-gray-300">Refund</th>
                    <th class="h6 text-gray-300">Date</th>
                    <th class="h6 text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $key => $payment)
                    <tr>
                        <td class="h6 mb-0 fw-medium text-gray-300">{{ $key + 1 }}</td>
                        <td class="h6 mb-0 fw-medium text-gray-300">#{{ $payment->booking_id }}</td>
                        <td class="h6 mb-0 fw-medium text-gray-300">{{ $payment->booking->guest->full_name ?? 'N/A' }}</td>
                        <td class="h6 mb-0 fw-medium text-gray-300">{{ ucfirst($payment->payment_method) }}</td>
                        <td class="h6 mb-0 fw-medium text-gray-300">Rs. {{ number_format($payment->amount_paid, 2) }}</td>
                        <td class="h6 mb-0 fw-medium text-gray-300">Rs. {{ number_format($payment->due_amount, 2) }}</td>
                        <td class="h6 mb-0 fw-medium text-gray-300">Rs. {{ number_format($payment->refund_amount ?? 0, 2) }}</td>
                        <td class="h6 mb-0 fw-medium text-gray-300">
                            {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y, h:i A') }}
                        </td>
                        <td class="h6 mb-0 fw-medium text-gray-300 d-flex gap-2">
                            <a href="{{ route('payments.edit', $payment->id) }}"
                               class="text-main-600 bg-main-50 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white text-center">
                                Edit
                            </a>
                            <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="d-inline">
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
