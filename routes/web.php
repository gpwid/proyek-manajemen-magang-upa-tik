<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PermohonanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Route;

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
