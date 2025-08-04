<?php

namespace App\Http\Controllers\SuperAdmin\Room;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
        // Convert amenities to array before validation
        $request->merge([
            'amenities' => array_map('trim', explode(',', $request->input('amenities')))
        ]);

        // Debug to confirm request input — remove this after testing
        // dd($request->all());

        // Validate input
        $validated = $request->validate([
            'room_number' => 'required|unique:rooms|max:255',
            'floor_number' => 'nullable|integer',
            'type' => 'required|in:Single,Deluxe,Suite',
            'price' => 'required|numeric',
            'occupancy_limit' => 'required|integer|min:1',
            'status' => 'required|in:available,occupied,maintenance',
            'amenities' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('rooms', 'public');
        }

        // Save room
        Room::create([
            'room_number' => $validated['room_number'],
            'floor_number' => $validated['floor_number'] ?? null,
            'type' => $validated['type'],
            'price' => $validated['price'],
            'occupancy_limit' => $validated['occupancy_limit'],
            'status' => $validated['status'],
            'amenities' => $validated['amenities'] ?? [],
            'image' => $validated['image'] ?? null,
        ]);

        // Redirect to index route (not view file)
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

    public function export()
{
    $rooms = Room::all();
    $csvData = "Room Number,Floor Number,Type,Price,Amenities,Occupancy Limit,Status,Image\n"; // Header

    foreach ($rooms as $room) {
        $csvData .= "{$room->room_number},{$room->floor_number},{$room->type},{$room->price},"
                    . (is_array($room->amenities) ? implode('; ', $room->amenities) : '') . ","
                    . "{$room->occupancy_limit},{$room->status},{$room->image}\n";
    }

    $filename = 'rooms.csv';

    return Response::make($csvData, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ]);
}

}
