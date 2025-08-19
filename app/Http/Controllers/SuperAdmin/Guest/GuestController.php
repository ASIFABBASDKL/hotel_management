<?php

namespace App\Http\Controllers\SuperAdmin\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Guest;

class GuestController extends Controller
{
    // Show all guests
    public function index()
    {
        $guests = Guest::latest()->paginate(10);
        return view('superadmin.guest.guest_management', compact('guests'));
    }

    public function create()
    {
        return view('superadmin.guest.add_guest');
    }
    // Store new guest
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'id_document' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('id_document')) {
            $validated['id_document_path'] = $request->file('id_document')->store('guests/id_docs', 'public');
        }

        Guest::create($validated);

        return redirect()->route('superadmin.guests.index')->with('success', 'Guest added successfully.');
    }
    public function edit($id)
    {
        $guest = Guest::findOrFail($id);
        return view('superadmin.guest.edit_guest', compact('guest'));
    }
    // Update guest
    public function update(Request $request, $id)
    {
        $guest = Guest::findOrFail($id);

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'id_document' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('id_document')) {
            $validated['id_document_path'] = $request->file('id_document')->store('guests/id_docs', 'public');
        }

        $guest->update($validated);

        return redirect()->back()->with('success', 'Guest updated successfully.');
    }

    // Delete guest
    public function destroy($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();

        return redirect()->back()->with('success', 'Guest deleted successfully.');
    }

    public function export()
    {
        $guests = Guest::all();
        $csvData = "Name,Email,Phone,Address,Status\n"; // Header

        foreach ($guests as $guest) {
            $csvData .= "{$guest->name},{$guest->email},{$guest->phone},"
                . "{$guest->address},{$guest->status}\n";
        }

        $filename = 'guests.csv';

        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
