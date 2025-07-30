<?php

namespace App\Http\Controllers\SuperAdmin\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['guest', 'room'])->latest()->get();
        $guests = Guest::all();
        $rooms = Room::where('status', 'available')->get();

        return view('superadmin.booking.booking_management', compact('bookings', 'guests', 'rooms'));
    }
    public function create()
    {
        $guests = Guest::all();
        $rooms = Room::all();
        return view('superadmin.booking.add_booking_management', compact('guests', 'rooms'));
    }
public function store(Request $request)
{
    $request->validate([
        'guest_id' => 'required|exists:guests,id',
        'room_id' => 'required|exists:rooms,id',
        'check_in' => 'required|date',
        'check_out' => 'required|date|after:check_in',
        'status' => 'required|in:booked,checked_in,checked_out,cancelled',
        'booking_type' => 'required|in:walk-in,online',
        'payment_status' => 'required|in:unpaid,partial,paid',
        'payment_method' => 'required|in:cash,card,bank_transfer,easypaisa,jazzcash',
        'total_amount' => 'nullable|numeric',
        'discount' => 'nullable|numeric',
        'is_active' => 'required|boolean',
    ]);

    Booking::create($request->all());

    return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
}
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $guests = Guest::all();
        $rooms = Room::all();
        return view('superadmin.booking.edit_booking_management', compact('booking', 'guests', 'rooms'));
    }
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking->update($request->all());

        return redirect()->back()->with('success', 'Booking updated successfully!');
    }
    public function show($id)
    {
        $booking = Booking::with(['guest', 'room'])->findOrFail($id);
        return view('superadmin.booking.show_booking', compact('booking'));
    }


    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Booking deleted successfully!');
    }
}
