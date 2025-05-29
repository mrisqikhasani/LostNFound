<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $users = [
            [
                'name' => 'Fakhri',
                'email' => 'fakhri@gmail.com',
                'password' => Hash::make('#Fakhri123'),
                'phone_number' => '081234567890',
                'role' => 'user',
            ],
        ];

        foreach ($users as $user) {
            // Supaya tidak duplikat saat di-seed ulang
            User::updateOrCreate(['email' => $user['email']], $user);
        }
    }
}
