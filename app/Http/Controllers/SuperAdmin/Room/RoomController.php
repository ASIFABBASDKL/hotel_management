<?php

namespace App\Http\Controllers\SuperAdmin\Room;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Display a listing of the rooms
    public function index()
    {
        $rooms = Room::all();
        return view('superadmin.room.room_management', compact('rooms'));
    }
    public function create()
    {
        return view('superadmin.room.add_room');
    }

    // Store a newly created room in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'room_number' => 'required|unique:rooms,room_number|max:255',
            'type' => 'required|in:Single,Deluxe,Suite',
            'price' => 'required|numeric',
            'occupancy_limit' => 'required|integer|min:1',
            'status' => 'required|in:available,occupied,maintenance',
        ]);

        Room::create([
            'room_number' => $validatedData['room_number'],
            'type' => $validatedData['type'],
            'price' => $validatedData['price'],
            'occupancy_limit' => $validatedData['occupancy_limit'],
            'status' => $validatedData['status'],
            'amenities' => $request->amenities ?? [],
        ]);

        return redirect()->route('rooms.index')->with('success', 'Room created successfully!');
    }
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('superadmin.room.edit_room', compact('room'));
    }

    // Update the specified room in the database
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'room_number' => 'required|max:255|unique:rooms,room_number,' . $id,
            'type' => 'required|in:Single,Deluxe,Suite',
            'price' => 'required|numeric',
            'occupancy_limit' => 'required|integer|min:1',
            'status' => 'required|in:available,occupied,maintenance',
        ]);

        $room = Room::findOrFail($id);
        $room->update([
            'room_number' => $validatedData['room_number'],
            'type' => $validatedData['type'],
            'price' => $validatedData['price'],
            'occupancy_limit' => $validatedData['occupancy_limit'],
            'status' => $validatedData['status'],
            'amenities' => $request->amenities ?? [],
        ]);

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully!');
    }

    // Remove the specified room from the database
    public function destroy($id)
{
    $room = Room::findOrFail($id);
    $room->delete();

    return redirect()->route('rooms.index')->with('success', 'Room deleted successfully!');
}

}
