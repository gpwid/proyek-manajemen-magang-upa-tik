<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InstituteController;
use App\Http\Controllers\admin\InternshipController;
use App\Http\Controllers\Admin\ParticipantController;
use App\Http\Controllers\Admin\PermohonanController;
use App\Http\Controllers\Admin\SupervisorController;
use App\Http\Controllers\admin\TaskController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/dashboard'); // root diarahkan ke dashboard admin

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Permohonan
    Route::get('/permohonan', [PermohonanController::class, 'index'])->name('permohonan.index');
    Route::get('/permohonan/data', [PermohonanController::class, 'data'])->name('permohonan.data'); // endpoint JSON Yajra
    Route::get('/permohonan/tambah', [PermohonanController::class, 'indexTambah'])->name('permohonan.tambah');
    Route::post('/permohonan/store', [PermohonanController::class, 'store'])->name('permohonan.store');
    Route::get('/permohonan/{permohonan}/edit', [PermohonanController::class, 'edit'])->name('permohonan.edit');
    Route::put('/permohonan/{permohonan}', [PermohonanController::class, 'update'])->name('permohonan.update');
    Route::get('/permohonan/detail/{permohonan}', [PermohonanController::class, 'show'])->name('permohonan.show');
    Route::patch('/permohonan/{permohonan}/status', [PermohonanController::class, 'updateStatus'])->name('permohonan.status');
    Route::get('/permohonan/export/excel', [PermohonanController::class, 'exportExcel'])
        ->name('permohonan.export.excel');
    Route::get('/permohonan/export/pdf', [PermohonanController::class, 'exportPdf'])
        ->name('permohonan.export.pdf');

    // Peserta
    Route::get('/peserta', [ParticipantController::class, 'index'])->name('peserta.index');
    Route::get('/peserta/data', [ParticipantController::class, 'data'])->name('peserta.data'); // <- endpoint DataTables
    Route::get('/peserta/show/{participant}', [ParticipantController::class, 'show'])->name('peserta.show');
    Route::get('/peserta/create', [ParticipantController::class, 'create'])->name('peserta.create');
    Route::post('/peserta/store', [ParticipantController::class, 'store'])->name('peserta.store');
    Route::get('/peserta/{participant}/edit', [ParticipantController::class, 'edit'])->name('peserta.edit');
    Route::put('/peserta/{participant}', [ParticipantController::class, 'update'])->name('peserta.update');
    Route::get('/peserta/export/excel', [ParticipantController::class, 'exportExcel'])
        ->name('peserta.export.excel');
    Route::get('/peserta/export/pdf', [ParticipantController::class, 'exportPdf'])
        ->name('peserta.export.pdf');

    // Pembimbing
    Route::get('/pembimbing', [SupervisorController::class, 'index'])->name('pembimbing.index');
    Route::get('/pembimbing/data', [SupervisorController::class, 'data'])->name('pembimbing.data'); // <- endpoint DataTables
    Route::get('/pembimbing/create', [SupervisorController::class, 'create'])->name('pembimbing.create');
    Route::post('/pembimbing', [SupervisorController::class, 'store'])->name('pembimbing.store');
    Route::get('/pembimbing/{supervisor}/edit', [SupervisorController::class, 'edit'])->name('pembimbing.edit');
    Route::put('/pembimbing/{supervisor}', [SupervisorController::class, 'update'])->name('pembimbing.update');
    Route::get('/pembimbing/export/excel', [SupervisorController::class, 'exportExcel'])
        ->name('pembimbing.export.excel');
    Route::get('/pembimbing/export/pdf', [SupervisorController::class, 'exportPdf'])
        ->name('pembimbing.export.pdf');

    // Instansi
    Route::get('/instansi', [InstituteController::class, 'index'])->name('instansi.index');
    Route::get('/instansi/data', [InstituteController::class, 'data'])->name('instansi.data'); // <- endpoint DataTables
    Route::get('/instansi/create', [InstituteController::class, 'create'])->name('instansi.create');
    Route::post('/instansi', [InstituteController::class, 'store'])->name('instansi.store');
    Route::get('/instansi/{institute}/edit', [InstituteController::class, 'edit'])->name('instansi.edit');
    Route::put('/instansi/{institute}', [InstituteController::class, 'update'])->name('instansi.update');
    Route::get('/instansi/export/excel', [InstituteController::class, 'exportExcel'])
        ->name('instansi.export.excel');
    Route::get('/instansi/export/pdf', [InstituteController::class, 'exportPdf'])
        ->name('instansi.export.pdf');

    // Internship/Magang
    Route::get('/magang', [InternshipController::class, 'index'])->name('internship.index');
    Route::get('/magang/data', [InternshipController::class, 'data'])->name('internship.data');
    Route::get('/magang/show/{internship}', [InternshipController::class, 'show'])->name('internship.show');
    Route::get('/magang/create', [InternshipController::class, 'create'])->name('internship.create');
    Route::post('/magang/store', [InternshipController::class, 'store'])->name('internship.store');
    Route::get('/magang/{internship}/edit', [InternshipController::class, 'edit'])->name('internship.edit');
    Route::put('/magang/{internship}', [InternshipController::class, 'update'])->name('internship.update');
    Route::get('/magang/export/excel', [InternshipController::class, 'exportExcel'])->name('internship.export.excel');
    Route::get('/magang/export/pdf', [InternshipController::class, 'exportPdf'])->name('internship.export.pdf');

    Route::get('/penugasan', [TaskController::class, 'index'])->name('penugasan.index');
});

require __DIR__.'/auth.php';
