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
     * Run the database seeds.
     */
    public function run(): void
    {
        $penemuUsers = User::where('role', 'user')->get();

        foreach ($penemuUsers as $user) {
            Report::create([
                'user_id' => $user->id,
                'nama_barang_temuan' => 'Tas Hitam ' . Str::random(5),
                'kategori' => 'Alat Makan & Minum', 
                'waktu_temuan' => now()->subDays(rand(1, 10)),
                'lokasi_temuan' => 'Di temukan di ruangan F842 ' . rand(1, 5),
                'region_kampus' => 'Depok',
                'deskripsi_umum' => 'Tas warna hitam ditemukan di sekitar tangga.',
                'deskripsi_khusus' => 'Ada gantungan kunci boneka kecil.',
                'status' => 'menunggu',
                'foto_url' => json_encode(['botol-minum-1.jpeg', 'botol-minum-2.jpeg']), // multiple images as JSON
            ]);
        }
    }
}
