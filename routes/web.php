<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PermohonanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PenugasanController;
use App\Http\Controllers\Admin\TambahPermohonanController;
use App\Http\Controllers\Admin\ParticipantController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/dashboard'); // root diarahkan ke dashboard admin

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/permohonan',              [PermohonanController::class, 'index'])->name('permohonan.index');
    Route::get('/permohonan/data',         [PermohonanController::class, 'data'])->name('permohonan.data'); // endpoint JSON Yajra
    Route::get('/permohonan/tambah',       [TambahPermohonanController::class, 'index'])->name('permohonan.tambah');
    Route::post('/permohonan/store',       [TambahPermohonanController::class, 'store'])->name('permohonan.store');
    Route::get('/permohonan/{permohonan}/edit', [PermohonanController::class, 'edit'])->name('permohonan.edit');
    Route::put('/permohonan/{permohonan}',      [PermohonanController::class, 'update'])->name('permohonan.update');
    Route::get('/permohonan/{permohonan}',       [PermohonanController::class, 'show'])->name('permohonan.show');
    Route::patch('/permohonan/{permohonan}/status', [PermohonanController::class, 'updateStatus'])->name('permohonan.status');

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


    Route::get('/penugasan', [PenugasanController::class, 'index'])->name('penugasan.index');
});



require __DIR__ . '/auth.php';
