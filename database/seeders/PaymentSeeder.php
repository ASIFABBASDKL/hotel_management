<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = Booking::pluck('id')->toArray();

        foreach ($bookings as $bookingId) {
            Payment::create([
                'booking_id' => $bookingId,
                'payment_method' => ['cash', 'card', 'online'][rand(0, 2)],
                'amount_paid' => rand(1000, 5000),
                'payment_date' => Carbon::now()->subDays(rand(0, 30)),
                'due_amount' => rand(0, 1000),
                'refund_amount' => rand(0, 500),
                'transaction_reference' => Str::upper(Str::random(10)),
                'note' => Str::random(20),
            ]);
        }
    }
}
