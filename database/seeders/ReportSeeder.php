<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dummy Booking Report
        Report::create([
            'report_type'  => 'booking',
            'generated_by' => 1, // assume user id 1 is superadmin
            'filters'      => [
                'date_from' => '2025-08-01',
                'date_to'   => '2025-08-10',
            ],
            'data' => [
                ['booking_id' => 1, 'guest' => 'Ali Khan', 'room' => '101', 'status' => 'booked'],
                ['booking_id' => 2, 'guest' => 'Sara Malik', 'room' => '202', 'status' => 'checked_in'],
            ],
            'file_path' => null,
        ]);

        // Dummy Guest Report
        Report::create([
            'report_type'  => 'guest',
            'generated_by' => 1,
            'filters'      => null,
            'data' => [
                ['guest_id' => 1, 'name' => 'Ali Khan', 'email' => 'ali@example.com'],
                ['guest_id' => 2, 'name' => 'Sara Malik', 'email' => 'sara@example.com'],
            ],
            'file_path' => null,
        ]);

        // Dummy Room Report
        Report::create([
            'report_type'  => 'room',
            'generated_by' => 1,
            'filters'      => null,
            'data' => [
                ['room_id' => 1, 'room_number' => '101', 'type' => 'Single', 'status' => 'available'],
                ['room_id' => 2, 'room_number' => '202', 'type' => 'Deluxe', 'status' => 'occupied'],
            ],
            'file_path' => null,
        ]);

        // Dummy Payment Report
        Report::create([
            'report_type'  => 'payment',
            'generated_by' => 1,
            'filters'      => [
                'date_from' => '2025-08-01',
                'date_to'   => '2025-08-18',
            ],
            'data' => [
                ['payment_id' => 1, 'booking_id' => 1, 'amount' => 5000, 'method' => 'cash'],
                ['payment_id' => 2, 'booking_id' => 2, 'amount' => 8000, 'method' => 'card'],
            ],
            'file_path' => null,
        ]);
    }
}
