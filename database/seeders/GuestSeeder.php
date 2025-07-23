<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('guests')->insert([
            [
                'full_name' => 'Ali Khan',
                'email' => 'ali.khan@example.com',
                'phone' => '03001234567',
                'address' => 'House 12, Street 5, Lahore',
                'gender' => 'Male',
                'date_of_birth' => '1990-01-15',
                'nationality' => 'Pakistani',
                'id_type' => 'CNIC',
                'id_document_path' => 'uploads/ids/ali_cnic.png',
                'profile_image' => 'uploads/profiles/ali.png',
                'emergency_contact' => '03111234567',
                'notes' => 'Prefers non-smoking room',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Sara Ahmad',
                'email' => 'sara.ahmad@example.com',
                'phone' => '03112345678',
                'address' => 'Flat 2B, Islamabad Heights',
                'gender' => 'Female',
                'date_of_birth' => '1995-03-22',
                'nationality' => 'Pakistani',
                'id_type' => 'Passport',
                'id_document_path' => 'uploads/ids/sara_passport.pdf',
                'profile_image' => 'uploads/profiles/sara.jpg',
                'emergency_contact' => '03011223344',
                'notes' => 'Vegetarian meal requested',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone' => '03451239876',
                'address' => '456 Mall Street, Karachi',
                'gender' => 'Male',
                'date_of_birth' => '1988-07-10',
                'nationality' => 'American',
                'id_type' => 'Driving License',
                'id_document_path' => 'uploads/ids/john_dl.jpg',
                'profile_image' => 'uploads/profiles/john.jpg',
                'emergency_contact' => '03219876543',
                'notes' => 'Allergic to peanuts',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Ayesha Siddiqui',
                'email' => 'ayesha.sid@example.com',
                'phone' => '03215678901',
                'address' => 'Block C, Multan',
                'gender' => 'Female',
                'date_of_birth' => '1992-11-05',
                'nationality' => 'Pakistani',
                'id_type' => 'CNIC',
                'id_document_path' => 'uploads/ids/ayesha_cnic.jpg',
                'profile_image' => 'uploads/profiles/ayesha.jpg',
                'emergency_contact' => '03334445566',
                'notes' => 'Late check-in expected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Michael Smith',
                'email' => 'm.smith@example.com',
                'phone' => '03009876543',
                'address' => 'Bahria Town, Rawalpindi',
                'gender' => 'Other',
                'date_of_birth' => '1985-05-30',
                'nationality' => 'Canadian',
                'id_type' => 'Passport',
                'id_document_path' => 'uploads/ids/michael_passport.pdf',
                'profile_image' => 'uploads/profiles/michael.jpg',
                'emergency_contact' => '03110009988',
                'notes' => 'Requires wheelchair access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
