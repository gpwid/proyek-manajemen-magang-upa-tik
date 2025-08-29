<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PermohonanController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard.index');
});

Route::get('/permohonan', [PermohonanController::class, 'index'])->name('admin.permohonan.index');
Route::get('/permohonan.tambah', [PermohonanController::class, 'create'])->name('admin.permohonan.tambah');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');


// Route::get('/permohonan', function () {
//     return view('permohonan.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

/* Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 }); */

require __DIR__.'/auth.php';
