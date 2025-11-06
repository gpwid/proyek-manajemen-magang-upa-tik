<?php

use App\Http\Controllers\Admin\AttendanceController;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('generate:qrcode', function () {
    // Panggil logika untuk memperbarui QR code
    app(AttendanceController::class)->showQrCode();
    $this->info('QR Code untuk absensi telah diperbarui.');
})->purpose('Generate QR Code untuk absensi harian');

Artisan::schedule(function ($schedule) {
    $schedule->command('generate:qrcode')->timezone('Asia/Jakarta')->dailyAt('00:00');
});
