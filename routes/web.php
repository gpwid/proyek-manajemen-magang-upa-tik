<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InstituteController;
use App\Http\Controllers\Admin\InternshipController;
use App\Http\Controllers\Admin\ParticipantController;
use App\Http\Controllers\Admin\PermohonanController;
use App\Http\Controllers\Admin\SupervisorController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Atasan\DashboardController as AtasanDashboardController;
use App\Http\Controllers\Atasan\InstituteController as AtasanInstituteController;
use App\Http\Controllers\Atasan\InternshipController as AtasanInternshipController;
use App\Http\Controllers\Atasan\ParticipantController as AtasanParticipantController;
use App\Http\Controllers\Atasan\PermohonanController as AtasanPermohonanController;
use App\Http\Controllers\Atasan\SupervisorController as AtasanSupervisorController;
use App\Http\Controllers\Atasan\TaskController as AtasanTaskController;
use App\Http\Controllers\Pemagang\DashboardController as PemagangDashboardController;
use App\Http\Controllers\Pemagang\LogbookController;
use App\Http\Controllers\Pembimbing\ParticipantController as PembimbingParticipantController;
use App\Http\Controllers\Pembimbing\TaskController as PembimbingTaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama sekarang akan menampilkan halaman login jika pengguna belum masuk
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    // Jika belum, tampilkan halaman login
    return view('auth.login');
});

// Route '/dashboard'
Route::get('/dashboard', [RedirectController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// BUNGKUS SEMUA ROUTE ADMIN DI DALAM MIDDLEWARE 'auth'
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

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
    Route::get('/peserta/{participant}/approve', [ParticipantController::class, 'approve'])->name('peserta.approve');
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
    Route::put('internship/{internship}/update-status', [InternshipController::class, 'updateStatus'])->name('internship.update-status');

    // -- Penugasan / Tasks --
    Route::get('/penugasan/data', [TaskController::class, 'data'])->name('penugasan.data');
    Route::resource('penugasan', TaskController::class)->names('penugasan')->parameters(['penugasan' => 'task']);

    // Pengguna
    Route::get('/users/data', [UsersController::class, 'data'])->name('users.data');
    Route::resource('users', UsersController::class)->names('users');
    Route::put('users/{user}/status', [UsersController::class, 'toggleStatus'])->name('users.status');

    Route::get('/attendance/qrcode', [\App\Http\Controllers\Admin\AttendanceController::class, 'showQrCode'])->name('attendance.qrcode');

    // -- Profil Pengguna (dari Breeze) --
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// BUNGKUS SEMUA ROUTE PEMAGANG DALAM MIDDLEWARE AUTH
Route::middleware(['auth', 'role:pemagang'])->prefix('pemagang')->name('pemagang.')->group(function () {

    Route::get('/dashboard', [PemagangDashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/logbook/data', [\App\Http\Controllers\Pemagang\LogbookController::class, 'data'])->name('logbook.data');
    Route::resource('logbook', LogbookController::class)->names('logbook');

    Route::get('/attendance/record', [\App\Http\Controllers\Pemagang\AttendanceController::class, 'record'])->name('attendance.record');

    Route::get('/attendance', [\App\Http\Controllers\Pemagang\AttendanceController::class, 'index'])->name('attendance.index');

    // -- Profil Pengguna (dari Breeze) --
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// BUNGKUS SEMUA ROUTE ATASAN DI DALAM MIDDLEWARE 'auth'
Route::middleware(['auth', 'role:atasan'])->prefix('atasan')->name('atasan.')->group(function () {

    Route::get('/dashboard', [AtasanDashboardController::class, 'index'])->name('dashboard.index');

    // -- Permohonan --
    Route::get('/permohonan/data', [AtasanPermohonanController::class, 'data'])->name('permohonan.data');
    Route::resource('permohonan', AtasanPermohonanController::class)->names('permohonan')->parameters(['permohonan' => 'application']);
    Route::patch('/permohonan/{application}/status', [AtasanPermohonanController::class, 'updateStatus'])->name('permohonan.status');
    Route::get('/permohonan/export/excel', [AtasanPermohonanController::class, 'exportExcel'])->name('permohonan.export.excel');
    Route::get('/permohonan/export/pdf', [AtasanPermohonanController::class, 'exportPdf'])->name('permohonan.export.pdf');

    // -- Peserta --
    Route::get('/peserta/data', [AtasanParticipantController::class, 'data'])->name('peserta.data');
    Route::resource('peserta', AtasanParticipantController::class)->names('peserta')->parameters(['peserta' => 'participant']);
    Route::get('/peserta/export/excel', [AtasanParticipantController::class, 'exportExcel'])->name('peserta.export.excel');
    Route::get('/peserta/export/pdf', [AtasanParticipantController::class, 'exportPdf'])->name('peserta.export.pdf');

    // -- Pembimbing --
    Route::get('/pembimbing/data', [AtasanSupervisorController::class, 'data'])->name('pembimbing.data');
    Route::resource('pembimbing', AtasanSupervisorController::class)
        ->names('pembimbing')
        ->parameters(['pembimbing' => 'supervisor']);
    Route::get('/pembimbing/export/excel', [AtasanSupervisorController::class, 'exportExcel'])->name('pembimbing.export.excel');
    Route::get('/pembimbing/export/pdf', [AtasanSupervisorController::class, 'exportPdf'])->name('pembimbing.export.pdf');

    // -- Instansi --
    Route::get('/instansi/data', [AtasanInstituteController::class, 'data'])->name('instansi.data');
    Route::resource('instansi', AtasanInstituteController::class)
        ->names('instansi')
        ->parameters(['instansi' => 'institute']);
    Route::get('/instansi/export/excel', [AtasanInstituteController::class, 'exportExcel'])->name('instansi.export.excel');
    Route::get('/instansi/export/pdf', [AtasanInstituteController::class, 'exportPdf'])->name('instansi.export.pdf');

    // -- Magang / Internship --
    Route::get('/internship/data', [AtasanInternshipController::class, 'data'])->name('internship.data');
    Route::resource('internship', AtasanInternshipController::class);
    Route::get('/internship/export/excel', [AtasanInternshipController::class, 'exportExcel'])->name('internship.export.excel');
    Route::get('/internship/export/pdf', [AtasanInternshipController::class, 'exportPdf'])->name('internship.export.pdf');

    // -- Penugasan / Tasks --
    Route::get('/penugasan/data', [AtasanTaskController::class, 'data'])->name('penugasan.data');
    Route::resource('penugasan', AtasanTaskController::class)->names('penugasan')->parameters(['penugasan' => 'task']);

    // -- Profil Pengguna (dari Breeze) --
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// PEMBIMBING
Route::middleware(['auth']) // tambahkan 'role:pembimbing' jika pakai Spatie
    ->prefix('pembimbing')
    ->name('pembimbing.')
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Pembimbing\DashboardController::class, 'index'])
            ->name('dashboard.index');

        Route::get('/peserta', [PembimbingParticipantController::class, 'index'])
            ->name('peserta.index');

        Route::get('/peserta/{participant}/tugas', [PembimbingTaskController::class, 'index'])
            ->name('tugas.index');
        Route::get('/peserta/{participant}/tugas/create', [PembimbingTaskController::class, 'create'])
            ->name('tugas.create');
        Route::post('/peserta/{participant}/tugas', [PembimbingTaskController::class, 'store'])
            ->name('tugas.store');
    });

// Memuat route-route autentikasi dari Breeze
require __DIR__.'/auth.php';
