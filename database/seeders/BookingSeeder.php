<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bookings')->insert([
            [
                'guest_id' => 1,
                'room_id' => 1,
                'booking_type' => 'online',
                'check_in' => Carbon::now()->addDays(2),
                'check_out' => Carbon::now()->addDays(5),
                'status' => 'booked',
                'notes' => 'Prefers top floor.',
                'cancellation_reason' => null,
               'booking_reference' => strtoupper(Str::random(10)),
                'payment_status' => 'unpaid',
                'total_amount' => 7500,
                'discount' => 0,
                'payment_method' => 'cash',
                'is_active' => true,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'guest_id' => 2,
                'room_id' => 2,
                'booking_type' => 'walk-in',
                'check_in' => Carbon::now()->subDays(1),
                'check_out' => Carbon::now()->addDays(1),
                'status' => 'checked_in',
                'notes' => 'Requested vegetarian meals.',
                'cancellation_reason' => null,
                 'booking_reference' => strtoupper(Str::random(10)),
                'payment_status' => 'paid',
                'total_amount' => 9000,
                'discount' => 500,
                'payment_method' => 'card',
                'is_active' => true,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'guest_id' => 3,
                'room_id' => 3,
                'booking_type' => 'online',
                'check_in' => Carbon::now()->subDays(5),
                'check_out' => Carbon::now()->subDays(2),
                'status' => 'checked_out',
                'notes' => 'No peanuts due to allergy.',
                'cancellation_reason' => null,
                'booking_reference' => strtoupper(Str::random(10)),
                'payment_status' => 'paid',
                'total_amount' => 12000,
                'discount' => 0,
                'payment_method' => 'card',
                'is_active' => true,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
