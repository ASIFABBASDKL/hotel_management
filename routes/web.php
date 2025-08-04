<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\Admin\DashboardController;
use App\Http\Controllers\SuperAdmin\Role\RoleController;
use App\Http\Controllers\SuperAdmin\Auth\AuthController;
use App\Http\Controllers\SuperAdmin\Room\RoomController;
use App\Http\Controllers\SuperAdmin\Guest\GuestController;
use App\Http\Controllers\SuperAdmin\Booking\BookingController;
use App\Http\Controllers\SuperAdmin\Payment\PaymentController;

// Auth Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/run-storage-link', function () {
    try {
        $target = storage_path('app/public');
        $link = public_path('storage');

        // Check if the target directory exists
        if (!File::exists($target)) {
            return redirect()->back()->withErrors(['message' => 'Target directory does not exist: ' . $target]);
        }

        // Delete the existing 'storage' link or folder if it exists
        if (File::exists($link)) {
            File::deleteDirectory($link); // Deletes the existing folder or symlink
        }

        // Manually copy files to the public 'storage' directory
        File::copyDirectory($target, $link);

        return redirect()->back()->with('success', 'Storage link created successfully! Existing folder was deleted, and new files were copied.');
    } catch (Exception $e) {
        return redirect()->back()->withErrors(['message' => $e->getMessage()]);
    }
})->name('run-storage-link');

// Protected Routes
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Role Management
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:view_roles');
    Route::get('/superadmin/roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:add_roles');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:add_roles');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:edit_roles');
    Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:edit_roles');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:delete_roles');

    // Rooms
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index')->middleware('permission:view_rooms');
    Route::get('/admin/rooms/create', [RoomController::class, 'create'])->name('rooms.create')->middleware('permission:add_rooms');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store')->middleware('permission:add_rooms');
    Route::get('/admin/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit')->middleware('permission:edit_rooms');
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('rooms.update')->middleware('permission:edit_rooms');
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy')->middleware('permission:delete_rooms');
    Route::get('rooms/export', [RoomController::class, 'export'])->name('rooms.export');


    // Guests
    Route::get('/superadmin/guests', [GuestController::class, 'index'])->name('superadmin.guests.index')->middleware('permission:view_guests');
    Route::get('/superadmin/guests/create', [GuestController::class, 'create'])->name('superadmin.guests.create')->middleware('permission:add_guests');
    Route::post('/superadmin/guests/store', [GuestController::class, 'store'])->name('superadmin.guests.store')->middleware('permission:add_guests');
    Route::get('/superadmin/guests/edit/{id}', [GuestController::class, 'edit'])->name('superadmin.guests.edit')->middleware('permission:edit_guests');
    Route::post('/superadmin/guests/update/{id}', [GuestController::class, 'update'])->name('superadmin.guests.update')->middleware('permission:edit_guests');
    Route::delete('/superadmin/guests/delete/{id}', [GuestController::class, 'destroy'])->name('superadmin.guests.destroy')->middleware('permission:delete_guests');
    Route::get('guests/export', [GuestController::class, 'export'])->name('guests.export');

    // Bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index')->middleware('permission:view_bookings');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create')->middleware('permission:add_bookings');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store')->middleware('permission:add_bookings');
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit')->middleware('permission:edit_bookings');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update')->middleware('permission:edit_bookings');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show')->middleware('permission:view_bookings');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy')->middleware('permission:delete_bookings');
    Route::get('bookings/export', [BookingController::class, 'export'])->name('bookings.export');

    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index')->middleware('permission:view_payments');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create')->middleware('permission:add_payments');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store')->middleware('permission:add_payments');
    Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit')->middleware('permission:edit_payments');
    Route::put('/payments/{id}', [PaymentController::class, 'update'])->name('payments.update')->middleware('permission:edit_payments');
    Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy')->middleware('permission:delete_payments');


});
