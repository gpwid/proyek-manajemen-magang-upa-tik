<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PermohonanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TambahPermohonanController;
use App\Http\Controllers\ParticipantController;
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
});

Route::get('/', function () {
    return view('admin.dashboard.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
Route::get('/permohonan', [PermohonanController::class, 'index'])->name('admin.permohonan.index');
Route::get('/permohonan.tambah', [PermohonanController::class, 'create'])->name('admin.permohonan.tambah');
Route::get('/peserta', [ParticipantController::class, 'index'])->name('admin.peserta.index');
Route::get('/peserta/show/{participant}', [ParticipantController::class, 'show'])->name('admin.peserta.show');
Route::get('/peserta/create', [ParticipantController::class, 'create'])->name('admin.peserta.create');
Route::post('/peserta', [ParticipantController::class, 'store'])->name('admin.peserta.store');
Route::get('/peserta/{participant}/edit', [ParticipantController::class, 'edit'])->name('admin.peserta.edit');
Route::put('/peserta/{participant}', [ParticipantController::class, 'update'])->name('admin.peserta.update');

require __DIR__.'/auth.php';
