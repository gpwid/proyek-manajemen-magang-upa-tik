<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Permohonan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {

        $totalPemagang = Participant::count();
        $permohonanPending = Permohonan::where('status', 'Proses')->count();
        $totalPenugasan = 12;
        $totalPengguna = 133;

        $hour = Carbon::now()->setTimezone('Asia/Jakarta')->hour;
        $greeting = '';

        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Selamat Pagi';
        } elseif ($hour >= 12 && $hour < 15) {
            $greeting = 'Selamat Siang';
        } elseif ($hour >= 15 && $hour < 18) {
            $greeting = 'Selamat Sore';
        } else {
            $greeting = 'Selamat Malam';
        }

        $genderCounts = Participant::query()
            ->select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->pluck('total', 'jenis_kelamin'); // Hasilnya: ['Laki-laki' => 10, 'Perempuan' => 15]

        $transformedGenderCounts = $genderCounts->mapWithKeys(function ($total, $gender) {
            $label = ($gender === 'L') ? 'Laki-laki' : 'Perempuan';

            return [$label => $total];
        }); // Hasilnya: collect(['Laki-laki' => 10, 'Perempuan' => 15])

        // Siapkan data agar mudah dibaca oleh ApexCharts
        $genderChartData = [
            'labels' => $transformedGenderCounts->keys(), // -> ['Laki-laki', 'Perempuan']
            'series' => $transformedGenderCounts->values(), // -> [10, 15]
        ];

        $permohonanCounts = Permohonan::query()
            // Hubungkan tabel permohonan dengan institutes berdasarkan id_institute
            ->join('institutes', 'permohonan.id_institute', '=', 'institutes.id')
            ->select('institutes.nama_instansi', DB::raw('count(permohonan.id) as total'))
            ->groupBy('institutes.nama_instansi')
            ->orderBy('total', 'desc')
            ->take(5) // Ambil 5 instansi dengan permohonan terbanyak
            ->pluck('total', 'nama_instansi');

        // Siapkan data agar mudah dibaca oleh ApexCharts
        $permohonanChartData = [
            'labels' => $permohonanCounts->keys(),
            'series' => $permohonanCounts->values(),
        ];

        return view('admin.dashboard.index', compact('totalPemagang', 'permohonanPending', 'totalPenugasan', 'totalPengguna', 'greeting', 'genderChartData', 'permohonanChartData'));
    }
}
