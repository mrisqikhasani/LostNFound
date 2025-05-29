<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Claim;
use Carbon\Carbon;


class ClaimController extends Controller
{
    public function showHistoryClaim(Request $request)
    {
        try {
            $userId = auth()->id();
            $query = Claim::with('report')->where('user_id', operator: $userId);
            // $query = Claim::with('report');

            if ($request->filled('status')) {
                $query->where('status_klaim', $request->status);
            }

            if ($request->filled('duration')) {
                switch ($request->duration) {
                    case 'this_week':
                        $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                        break;
                    case 'this_month':
                        $query->whereMonth('created_at', Carbon::now()->month);
                        break;
                    case 'last_3_months':
                        $query->where('created_at', '>=', Carbon::now()->subMonths(3));
                        break;
                    case 'last_6_months':
                        $query->where('created_at', '>=', Carbon::now()->subMonths(6));
                        break;
                    case 'this_year':
                        $query->whereYear('created_at', Carbon::now()->year);
                        break;
                }
            }

            $claimsUser = $query->latest()->paginate(10);

            // Handle null result
            if ($claimsUser->isEmpty()) {
                $error = 'Tidak ada data klaim ditemukan.';
                $success = null;
            } else {
                $error = session('error');
                $success = session('success');
            }

            return view('user.history', compact('claimsUser', 'error', 'success'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

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
