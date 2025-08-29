<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard.index');
});

Route::get('/permohonan', function () {
    return view('admin.dashboard.index');
});

Route::get('/permohonan', [App\Http\Controllers\Admin\PermohonanController::class, 'index'])->name('admin.permohonan.index');

Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');


/* Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 }); */

require __DIR__.'/auth.php';
