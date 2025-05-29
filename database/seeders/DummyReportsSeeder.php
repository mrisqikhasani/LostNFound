<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DummyReportsSeeder extends Seeder
{
    /**
     * Jalankan seed dari database
     */
    public function run(): void
    {
        $user = User::where('role', 'user')->latest()->first();

        if ($user) {
            $now = now();

            DB::table('reports')->insert([
            'user_id' => $user->id,
            'nama_barang_temuan' => 'TWS ThinkPlus Hitam',
            'kategori' => 'Aksesoris',
            'waktu_temuan' => $now,
            'lokasi_temuan' => 'Di temukan di ruangan F8425',
            'region_kampus' => 'Depok',
            'deskripsi_umum' => 'TWS warna hitam yang ditemukan di meja ruangan.',
            'deskripsi_khusus' => 'Ada titik putih yang menempel di dalam TWS',
            'status' => 'menunggu',
            'foto_url' => json_encode(['tws-1.jpeg', 'tws-2.jpeg', 'tws-3.jpeg']),
            'created_at' => $now,
            'updated_at' => $now,
            ]);
        }
    }
}
