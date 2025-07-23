<?php

namespace App\Http\Controllers\SuperAdmin\Payment;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking')->latest()->get();
        $bookings = Booking::all();
        return view('superadmin.payment.payment_management', compact('payments', 'bookings'));
    }
    public function create()
    {
        $bookings = Booking::with('guest')->get();
        return view('superadmin.payment.add_payment_management', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|in:cash,card,online',
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'nullable|date',
            'due_amount' => 'nullable|numeric|min:0',
            'refund_amount' => 'nullable|numeric|min:0',
            'transaction_reference' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ]);

        Payment::create($request->all());
        return redirect()->back()->with('success', 'Payment recorded successfully.');
    }
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $bookings = Booking::with('guest')->get();

        return view('superadmin.payment.edit_payment_management', compact('payment', 'bookings'));
    }
    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|in:cash,card,online',
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'nullable|date',
            'due_amount' => 'nullable|numeric|min:0',
            'refund_amount' => 'nullable|numeric|min:0',
            'transaction_reference' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ]);

        $payment->update($request->all());
        return redirect()->back()->with('success', 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->back()->with('success', 'Payment deleted successfully.');
    }
}
