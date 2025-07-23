<?php

namespace App\Http\Controllers\SuperAdmin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room; // Add at top
use App\Models\Guest; // Add this at the top
use App\Models\Booking;


class DashboardController extends Controller
{
    public function index()
    {
        $totalRooms = Room::count(); // Count all rooms
        $totalGuests = Guest::count(); // 👈 Add this line
        $totalBookings = Booking::count(); // ✅ Add this line

        return view('superadmin.dashboard', compact('totalRooms', 'totalGuests', 'totalBookings'));
    }


}
