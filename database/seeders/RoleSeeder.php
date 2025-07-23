<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inserting predefined roles
        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'description' => 'Administrator with full access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'description' => 'Regular user with limited access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Waiter',
                'description' => 'Waiter for handling orders',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
