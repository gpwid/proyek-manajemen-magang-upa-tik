<?php

// app/Http\Controllers/Pemagang/AttendanceController.php

namespace App\Http\Controllers\Pemagang;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    public function index()
    {
        $participant = Auth::user()->participant;
        $attendances = Attendance::where('participant_id', $participant->id)
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('pemagang.attendance.index', compact('attendances'));
    }

    public function record(Request $request)
    {
        // 1. Validasi URL yang ditandatangani (dari QR Code)
        if (! $request->hasValidSignature()) {
            $redirectUrl = route('dashboard');
            $message = 'URL absensi tidak valid atau telah kedaluwarsa. Silakan coba lagi dengan memindai QR code terbaru.';

            return response()->view('errors.invalid_absen', [
                'message' => $message,
                'redirectUrl' => $redirectUrl,
            ], 403);
        }

        $clientIp = $request->ip();
        $isIpAllowed = Str::startsWith($clientIp, '172.') || $clientIp === '127.0.0.1';

        // 2. Validasi Alamat IP
        if (! $isIpAllowed) {
            $message = "Anda harus terhubung ke jaringan WiFi kampus yang diizinkan untuk melakukan absensi. (IP Anda: {$clientIp})";

            return view('pemagang.attendance.result', ['isError' => true, 'message' => $message]);
        }

        $participant = Auth::user()->participant;
        $today = Carbon::today()->toDateString();
        $now = now();
        $nowJakarta = $now->setTimezone('Asia/Jakarta');
        $type = $request->query('type'); // 'check-in' atau 'check-out'

        // Dapatkan atau buat data absensi untuk hari ini
        $attendance = Attendance::firstOrNew([
            'participant_id' => $participant->id,
            'date' => $today,
        ]);

        // Logika untuk check-in atau check-out
        if ($type === 'check-in') {
            if ($attendance->check_in_time) {
                return view('pemagang.attendance.result', ['isError' => true, 'message' => 'Anda sudah melakukan check-in hari ini.']);
            }
            $attendance->check_in_time = $now;
            $attendance->check_in_ip_address = $request->ip();
            $attendance->save();

            return view('pemagang.attendance.result', ['message' => 'Check-in berhasil direkam pada pukul '.$nowJakarta->format('H:i:s')]);
        }

        if ($type === 'check-out') {
            if (is_null($attendance->check_in_time)) {
                return view('pemagang.attendance.result', ['isError' => true, 'message' => 'Anda harus melakukan check-in terlebih dahulu sebelum check-out.']);
            }
            if ($attendance->check_out_time) {
                return view('pemagang.attendance.result', ['isError' => true, 'message' => 'Anda sudah melakukan check-out hari ini.']);
            }
            $attendance->check_out_time = $now;
            $attendance->check_out_ip_address = $request->ip();
            $attendance->save();

            return view('pemagang.attendance.result', ['message' => 'Check-out berhasil direkam pada pukul '.$nowJakarta->format('H:i:s')]);
        }

        return view('pemagang.attendance.result', ['isError' => true, 'message' => 'Tipe absensi tidak dikenal.']);
    }
}
