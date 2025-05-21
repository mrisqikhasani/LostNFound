<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Report;
use App\Models\Claim;

class HistoryController extends Controller
{
    //

    public function showHistory(Request $request)
    {
        $tab = $request->get('tab', 'claim');

        if($tab == 'claim'){
            return $this->showHistoryClaim($request);
        } else {
            return $this->showHistoryReport($request);
        }

    }

    public function showHistoryReport(Request $request)
    {
        try {
            $userId = auth()->id();
            $query = Report::where('user_id', $userId);

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('duration')) {
                switch ($request->duration) {
                    case 'all':
                        // No additional query needed for 'all' duration; show all records
                        break;
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

            $reportsUser = $query->latest()->paginate();

            if($reportsUser->isEmpty()){
                $error = 'Not data report found';
                $success = null;
            } else {
                $error = session('error');
                $success = session('success');
            }

            $tab = 'report';
            return view('user.history', compact('reportsUser', 'success', 'error', 'tab'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Terjadi kesalahan :' . $th->getMessage());
        }
    }

    
    public function showHistoryClaim(Request $request)
    {
        try {
            $userId = auth()->id();
                $query = Claim::with('report')->where('user_id', $userId);
            // $query = Claim::with('report');

            if ($request->filled('status')) {
                $query->where('status_klaim', $request->status);
            }

            if ($request->filled('duration')) {
                switch ($request->duration) {
                    case 'all':
                        break;
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


            $tab = 'claim';
            $claimsUser = $query->latest()->paginate(12);

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

}
