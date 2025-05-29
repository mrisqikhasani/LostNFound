<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Str;

class DummyReportsSeeder extends Seeder
{
    /**
     * Jalankan seed dari database
     */
    public function run(): void
    {
        $penemuUsers = User::where('role', 'user')->get();

        foreach ($penemuUsers as $user) {
            Report::create([
                'user_id' => $user->id,
                'nama_barang_temuan' => 'TWS ThinkPlus Hitam',
                'kategori' => 'Aksesoris', 
                'waktu_temuan' => now(),
                'lokasi_temuan' => 'Di temukan di ruangan F8425',
                'region_kampus' => 'Depok',
                'deskripsi_umum' => 'TWS warna hitam yang ditemukan di meja ruangan.',
                'deskripsi_khusus' => 'Ada titik putih yang menempel di dalam TWS',
                'status' => 'menunggu',
                'foto_url' => ['tws-1.jpeg', 'tws-2.jpeg', 'tws-3.jpeg'], // beberapa foto diletakka dalam format JSON
            ]);
        }
    }
}
