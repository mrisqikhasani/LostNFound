<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\HistoryController;

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

// Home
Route::get('/', [ReportController::class, 'index']);


Route::middleware('auth')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Report
    Route::get('/report', [ReportController::class, 'showReportFoundForm'])->name('report.showForm');  
    Route::post('/report', [ReportController::class, 'submitReport'])->name('report.submitReport');
    // Report Find barang
    Route::get('/report/{id}', [ReportController::class, 'showPageId'])->name('produk.show');
    
    
    // Claims
    Route::post('/claim', [ClaimController::class, 'submitClaim'])->name('claim.submit');
    
    // Route::get('/history', [HistoryController::class, 'getHistoryReports'])->name('report.getHistoryReports');
    Route::get('/history', [HistoryController::class, 'showHistory'])->name('history');
});
