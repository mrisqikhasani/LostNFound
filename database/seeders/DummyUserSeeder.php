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
                'name' => 'Penemu Satu',
                'email' => 'penemu1@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '081234567890',
                'role' => 'user',
            ],
            [
                'name' => 'Penemu Dua',
                'email' => 'penemu2@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '081234567890',
                'role' => 'user',
            ],
            [
                'name' => 'Pencari Satu',
                'email' => 'pencari1@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '081234567890',
                'role' => 'user',
            ],
            [
                'name' => 'Pencari Dua',
                'email' => 'pencari2@example.com',
                'password' => Hash::make('password'),
                'phone_number' => '081234567890',
                'role' => 'user',
            ],
            [
                'name' => 'Pencari Tiga',
                'email' => 'pencari3@example.com',
                'password' => Hash::make('password'),
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
