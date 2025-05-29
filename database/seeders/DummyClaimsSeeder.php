<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Claim;
use App\Models\User;
use App\Models\Report;

class DummyClaimsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pencariUsers = User::where('role', 'user')->get();
        $reports = Report::all();

        foreach ($reports as $report) {
            // Biar nggak semua report langsung ada klaim
            if (rand(0, 1)) {
                $claimer = $pencariUsers->random();

                Claim::create([
                    'user_id' => $claimer->id,
                    'report_id' => $report->id,
                    'deskripsi_verifikasi' => 'Ini adalah TWS saya, saya menggunakannya setiap hari dimanapun dan kapanpun',
                    'status_klaim' => 'diproses', // nanti admin ubah ke disetujui/ditolak
                    'tanggal_klaim' => now(),
                ]);
            }
        }
    }
}
