<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;


class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->get();
        

        return view('report', compact('reports'));
    }

    public function showReportFoundForm()
    {
        return view('reportform');
    }


}
