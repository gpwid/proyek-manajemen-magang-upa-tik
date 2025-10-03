<?php

namespace App\Http\Controllers\Pemagang;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Logbook;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $participant = $user->participant;
        $greeting = $this->getGreeting();

        // Cari sesi magang yang aktif
        $activeInternship = $participant->internships()->where('status_magang', 'Aktif')->with(['permohonan.institute', 'supervisor'])->first();

        $logbookCount = 0;
        $todayAttendance = null;

        if ($activeInternship) {
            // Hitung jumlah logbook yang sudah diisi untuk magang ini
            $logbookCount = Logbook::where('internship_id', $activeInternship->id)
                ->where('participant_id', $participant->id)
                ->count();

            // Cek status absensi hari ini
            $todayAttendance = Attendance::where('participant_id', $participant->id)
                ->where('date', now()->toDateString())
                ->first();
        }

        return view('pemagang.dashboard.index', compact(
            'user',
            'greeting',
            'activeInternship',
            'logbookCount',
            'todayAttendance'
        ));
    }

    /**
     * Mendapatkan sapaan berdasarkan waktu.
     */
    private function getGreeting(): string
    {
        $hour = now()->setTimezone('Asia/Jakarta')->hour;

        if ($hour >= 5 && $hour < 12) {
            return 'Selamat Pagi';
        } elseif ($hour >= 12 && $hour < 15) {
            return 'Selamat Siang';
        } elseif ($hour >= 15 && $hour < 18) {
            return 'Selamat Sore';
        } else {
            return 'Selamat Malam';
        }
    }
}
