<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;

// auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('users.dashboard');
    })->name('dashboard');
});

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/form', [ReportController::class, 'showReportFoundForm']);

// komentar dulu ya
// Route::get('/', function () {
//     return view('reports');
// });

// ini yang aku buat kakkk
Route::get('/', function () {
    return view('user.login');
})->name('login');

Route::get('/daftar', function () {
    return view('user.signup');
})->name('daftar');

Route::get('/beranda', function () {
    return view('user.home');
})->name('beranda');

Route::get('/lapor', function () {
    return view('user.forms');
})->name('lapor');

Route::get('/riwayat', function () {
    return view('user.history');
})->name('riwayat');

// Route::get('/barang/{id}', [BarangController::class, 'show'])->name('produk.show');
Route::get('/barang/BRG-001', function () {
    return view('user.details');
})->name('barang');