<?php

namespace App\Http\Controllers\Pemagang;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {

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

        return view('pemagang.dashboard.index', compact('greeting'));
    }
}
