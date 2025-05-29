<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Fakhri',
                'email' => 'fakhri@gmail.com',
                'password' => Hash::make('#Fakhri123'),
                'phone_number' => '081234567890',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Seder',
                'email' => 'seder@gmail.com',
                'password' => Hash::make('#Seder123'),
                'phone_number' => '081298765432',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Farhan',
                'email' => 'farhan@gmail.com',
                'password' => Hash::make('farhan@123'),
                'phone_number' => '081298765432',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
