<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Supervisor;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Ambil supervisor_id dari user yang login
        $userId = Auth::id();
        $supervisorId = Supervisor::where('user_id', $userId)->value('id');

        abort_unless($supervisorId, 403, 'Akun ini belum terhubung ke data pembimbing.');

        // 1) Kartu ringkas
        $totalBinaan = Participant::where('supervisor_id', $supervisorId)->count();

        $participantIds = Participant::where('supervisor_id', $supervisorId)->pluck('id');

        $totalTugas = Task::whereIn('participant_id', $participantIds)->count();

        $tugasSelesai = Task::whereIn('participant_id', $participantIds)
            ->where('status', 'Selesai')->count();

        $tugasOutstanding = Task::whereIn('participant_id', $participantIds)
            ->whereIn('status', ['Dikerjakan', 'Revisi'])->count();

        // 2) Greeting (zona waktu Asia/Jakarta seperti dashboard admin)
        $hour = Carbon::now()->setTimezone('Asia/Jakarta')->hour;
        $greeting = ($hour >= 5 && $hour < 12) ? 'Selamat Pagi'
                  : (($hour >= 12 && $hour < 15) ? 'Selamat Siang'
                  : (($hour >= 15 && $hour < 18) ? 'Selamat Sore' : 'Selamat Malam'));

        // 3) Chart Gender (hanya peserta binaan)
        $genderCounts = Participant::query()
            ->where('supervisor_id', $supervisorId)
            ->select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->pluck('total', 'jenis_kelamin'); // ['L' => 10, 'P' => 15]

        $transformedGenderCounts = $genderCounts->mapWithKeys(function ($total, $gender) {
            $label = ($gender === 'L') ? 'Laki-laki' : 'Perempuan';
            return [$label => $total];
        });

        $genderChartData = [
            'labels' => $transformedGenderCounts->keys()->values(),
            'series' => $transformedGenderCounts->values()->map(fn($v) => (int) $v)->values(),
        ];

        // 4) Chart Status Tugas (untuk peserta binaan)
        $statusCounts = Task::query()
            ->whereIn('participant_id', $participantIds)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status'); // ex: ['Dikerjakan'=>5,'Revisi'=>2,'Selesai'=>12]

        // Pastikan urutan label konsisten
        $statusLabels = ['Dikerjakan','Revisi','Selesai'];
        $statusSeries = collect($statusLabels)->map(fn($s) => (int) ($statusCounts[$s] ?? 0));

        $statusChartData = [
            'labels' => $statusLabels,
            'series' => $statusSeries->values(),
        ];

        return view(
            'pembimbing.dashboard.index',
            compact(
                'greeting',
                'totalBinaan',
                'totalTugas',
                'tugasSelesai',
                'tugasOutstanding',
                'genderChartData',
                'statusChartData'
            )
        );
    }
}
