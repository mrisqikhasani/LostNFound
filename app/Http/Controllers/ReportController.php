<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Get all possible enum values for 'region_kampus' column from the database
        $type = \DB::select("SHOW COLUMNS FROM reports WHERE Field = 'region_kampus'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $regions = [];
        if (!empty($matches[1])) {
            $regions = array_map(function ($value) {
                return trim($value, "'");
            }, explode(',', $matches[1]));
        }

        $categoryTypes = \DB::select("SHOW COLUMNS FROM reports WHERE Field = 'kategori'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $categoryTypes, $categoryMatches);
        $categories = [];
        if (!empty($categoryMatches[1])) {
            $categories = array_map(function ($value) {
                return trim($value, "'");
            }, explode(',', $categoryMatches[1]));
        }

        $query = Report::where('status', 'disetujui');

        // Cek sort param
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'category':
                    $query->orderBy('kategori', 'asc');
                    break;
                case 'date':
                    $query->orderBy('waktu_temuan', 'desc');
                    break;
                case 'region':
                    $query->orderBy('region_kampus', 'asc');
                    break;
                case 'none':
                    break;
                default:
                    $query->oldest();
            }
        } else {
            $query->oldest();
        }

        $reports = $query->paginate();

        $title = 'Beranda';

        return view('user.home', compact('reports', 'regions', 'categories', 'title'));
    }

    public function showPageId($id)
    {
        $reportById = Report::findOrFail($id);
        $title = 'Detail Barang';

        return view('user.details', compact('reportById', 'title'));
    }

    public function showReportFoundForm()
    {
        $type = \DB::select("SHOW COLUMNS FROM reports WHERE Field = 'region_kampus'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $regions = [];
        if (!empty($matches[1])) {
            $regions = array_map(function ($value) {
                return trim($value, "'");
            }, explode(',', $matches[1]));
        }

        $categoryTypes = \DB::select("SHOW COLUMNS FROM reports WHERE Field = 'kategori'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $categoryTypes, $categoryMatches);
        $categories = [];
        if (!empty($categoryMatches[1])) {
            $categories = array_map(function ($value) {
                return trim($value, "'");
            }, explode(',', $categoryMatches[1]));
        }

        $title = 'Lapor';
        return view('user.forms', compact('regions', 'categories', 'title'));
    }

    public function submitReport(Request $request)
    {
        try {
            $validate = $request->validate([
                'nama_barang_temuan' => 'required|string',
                'waktu_temuan' => 'required|string',
                'region_kampus' => 'required|string',
                'lokasi_temuan' => 'string'
            ]);

            // uploadimages multiple
            $uploadedImages = $request->file('foto_url');
            $filePaths = [];



            if ($uploadedImages) {
                // dd($uploadedImages);
                foreach ($uploadedImages as $img) {
                    $path = $img->store('reports', 'public');
                    $filePaths[] = $path;
                }
            } else if (!$uploadedImages) {
                // dd('Not file terdection');
            }


            Report::create([
                'user_id' => auth()->id(),
                'nama_barang_temuan' => $request->nama_barang_temuan,
                'kategori' => $request->kategori,
                'waktu_temuan' => $request->waktu_temuan,
                'lokasi_temuan' => $request->lokasi_temuan,
                'region_kampus' => $request->region_kampus,
                'deskripsi_umum' => $request->deskripsi_umum,
                'deskripsi_khusus' => $request->deskripsi_khusus,
                'status' => 'menunggu',
                'foto_url' => $filePaths,
            ]);

            return redirect('/')->with('success', 'Report berhasil dibuat.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat report: ' . $th->getMessage())->withInput();
        }
    }
}
