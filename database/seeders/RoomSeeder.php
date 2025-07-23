<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms')->insert([
            [
                'room_number' => '101',
                'floor_number' => 1,
                'type' => 'Single',
                'price' => 2500.00,
                'amenities' => json_encode(['WiFi', 'TV']),
                'occupancy_limit' => 1,
                'status' => 'available',
                'image' => 'rooms/101.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_number' => '102',
                'floor_number' => 1,
                'type' => 'Deluxe',
                'price' => 4500.00,
                'amenities' => json_encode(['WiFi', 'TV', 'AC']),
                'occupancy_limit' => 2,
                'status' => 'available',
                'image' => 'rooms/102.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_number' => '201',
                'floor_number' => 2,
                'type' => 'Suite',
                'price' => 8000.00,
                'amenities' => json_encode(['WiFi', 'TV', 'AC', 'Mini Bar']),
                'occupancy_limit' => 4,
                'status' => 'maintenance',
                'image' => 'rooms/201.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
