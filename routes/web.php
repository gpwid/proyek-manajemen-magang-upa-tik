<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InstituteController;
// Admin Controllers
use App\Http\Controllers\Admin\InternshipController;
use App\Http\Controllers\Admin\ParticipantController;
use App\Http\Controllers\Admin\PermohonanController;
use App\Http\Controllers\Admin\SupervisorController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama sekarang akan menampilkan halaman login jika pengguna belum masuk
Route::get('/', function () {
    if (Auth::check()) { // <-- Memanggil Auth::check()
        return redirect()->route('admin.dashboard.index');
    }

    return view('auth.login');
});

// Route default '/dashboard' dari Breeze kita arahkan ke dashboard admin
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// BUNGKUS SEMUA ROUTE ADMIN DI DALAM MIDDLEWARE 'auth'
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // -- Permohonan --
    Route::get('/permohonan/data', [PermohonanController::class, 'data'])->name('permohonan.data');
    Route::resource('permohonan', PermohonanController::class)->names('permohonan')->parameters(['permohonan' => 'application']);
    Route::patch('/permohonan/{application}/status', [PermohonanController::class, 'updateStatus'])->name('permohonan.status');
    Route::get('/permohonan/export/excel', [PermohonanController::class, 'exportExcel'])->name('permohonan.export.excel');
    Route::get('/permohonan/export/pdf', [PermohonanController::class, 'exportPdf'])->name('permohonan.export.pdf');

    // -- Peserta --
    Route::get('/peserta/data', [ParticipantController::class, 'data'])->name('peserta.data');
    Route::resource('peserta', ParticipantController::class)->names('peserta')->parameters(['peserta' => 'participant']);
    Route::get('/peserta/export/excel', [ParticipantController::class, 'exportExcel'])->name('peserta.export.excel');
    Route::get('/peserta/export/pdf', [ParticipantController::class, 'exportPdf'])->name('peserta.export.pdf');

    // -- Pembimbing --
    Route::get('/pembimbing/data', [SupervisorController::class, 'data'])->name('pembimbing.data');
    Route::resource('pembimbing', SupervisorController::class)
        ->names('pembimbing')
        ->parameters(['pembimbing' => 'supervisor']);
    Route::get('/pembimbing/export/excel', [SupervisorController::class, 'exportExcel'])->name('pembimbing.export.excel');
    Route::get('/pembimbing/export/pdf', [SupervisorController::class, 'exportPdf'])->name('pembimbing.export.pdf');

    // -- Instansi --
    Route::get('/instansi/data', [InstituteController::class, 'data'])->name('instansi.data');
    Route::resource('instansi', InstituteController::class)
        ->names('instansi')
        ->parameters(['instansi' => 'institute']);
    Route::get('/instansi/export/excel', [InstituteController::class, 'exportExcel'])->name('instansi.export.excel');
    Route::get('/instansi/export/pdf', [InstituteController::class, 'exportPdf'])->name('instansi.export.pdf');

    // -- Magang / Internship --
    Route::get('/internship/data', [InternshipController::class, 'data'])->name('internship.data');
    Route::resource('internship', InternshipController::class);
    Route::get('/internship/export/excel', [InternshipController::class, 'exportExcel'])->name('internship.export.excel');
    Route::get('/internship/export/pdf', [InternshipController::class, 'exportPdf'])->name('internship.export.pdf');

    // -- Penugasan / Tasks --
    Route::get('/penugasan/data', [TaskController::class, 'data'])->name('penugasan.data');
    Route::resource('penugasan', TaskController::class)->names('penugasan')->parameters(['penugasan' => 'task']);

    // -- Profil Pengguna (dari Breeze) --
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memuat route-route autentikasi dari Breeze
require __DIR__.'/auth.php';
