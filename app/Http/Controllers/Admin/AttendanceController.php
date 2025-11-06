<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function showQrCode(): View
    {
        $now = Carbon::now('Asia/Jakarta'); // Waktu lokal
        $startOfDay = $now->copy()->startOfDay(); // Pukul 12:00 malam

        // QR Check-In: Berlaku dari pukul 6:00 pagi hingga 12:00 siang
        $checkInStart = $startOfDay->copy()->addHours(6);
        $checkInEnd = $startOfDay->copy()->addHours(12);

        // QR Check-Out: Berlaku dari pukul 1:30 siang hingga 6:30 sore
        $checkOutStart = $startOfDay->copy()->addHours(13)->addMinutes(30);
        $checkOutEnd = $startOfDay->copy()->addHours(18)->addMinutes(30);

        // Tentukan QR code yang akan ditampilkan berdasarkan waktu saat ini
        $currentQrType = null;
        $currentQrUrl = null;
        $currentQrStart = null;
        $currentQrEnd = null;

        if ($now->between($checkInStart, $checkInEnd)) {
            $currentQrType = 'Check-In';
            $currentQrUrl = URL::temporarySignedRoute(
                'pemagang.attendance.record',
                $checkInEnd,
                ['type' => 'check-in']
            );
            $currentQrStart = $checkInStart;
            $currentQrEnd = $checkInEnd;
        } elseif ($now->between($checkOutStart, $checkOutEnd)) {
            $currentQrType = 'Check-Out';
            $currentQrUrl = URL::temporarySignedRoute(
                'pemagang.attendance.record',
                $checkOutEnd,
                ['type' => 'check-out']
            );
            $currentQrStart = $checkOutStart;
            $currentQrEnd = $checkOutEnd;
        }

        return view('admin.attendance.qrcode', compact('currentQrType', 'currentQrUrl', 'currentQrStart', 'currentQrEnd'));
    }
}
