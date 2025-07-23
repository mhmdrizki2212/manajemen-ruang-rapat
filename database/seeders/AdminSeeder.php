<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Satu',
                'email' => 'admin1@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Muhammad Rizki',
                'email' => 'm.rizki@gmail.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
