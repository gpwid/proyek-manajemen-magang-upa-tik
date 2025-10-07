<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function showQrCode(): View
    {
        // Membuat URL yang hanya valid selama 60 detik
        $checkInUrl = URL::temporarySignedRoute(
            'pemagang.attendance.record', now()->addSeconds(120), ['type' => 'check-in']
        );

        $checkOutUrl = URL::temporarySignedRoute(
            'pemagang.attendance.record', now()->addSeconds(120), ['type' => 'check-out']
        );

        return view('admin.attendance.qrcode', compact('checkInUrl', 'checkOutUrl'));
    }
}
