<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Claim;
use Carbon\Carbon;


class ClaimController extends Controller
{

    public function submitClaim(Request $request)
    {
        // Validate the request including the image
        try {
            $validated = $request->validate([
            'report_id' => 'required|exists:reports,id',
            'deskripsi_verifikasi' => 'required|string',
            ]);
            
            // Handle the uploaded image
            $fotoPath = null;
            if ($request->hasFile('foto_verifikasi')) {
                $fotoPath = $request->file('foto_verifikasi')->store('foto_verifikasi', 'public');
            }

            Claim::create([
            'user_id' => auth()->id(),
            'report_id' => $request->report_id,
            'deskripsi_verifikasi' => $request->deskripsi_verifikasi,
            'foto_verifikasi' => $fotoPath,
            'status_klaim' => 'diproses',
            'tanggal_klaim' => now()
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengirim klaim: ' . $e->getMessage());
        }

    return redirect()->route('history', ['tab' => 'claim'])->with('success', 'Klaim berhasil dikirim.');
    }
}
