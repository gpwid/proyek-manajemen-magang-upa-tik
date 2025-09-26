<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    /**
     * Mengarahkan pengguna ke dashboard yang sesuai berdasarkan peran mereka.
     */
    public function dashboard()
    {
        $user = Auth::user();

        // Gunakan helper method yang sudah ada di model User
        if ($user->isAdmin()) {
            // Jika role adalah admin, atasan, atau pembimbing, arahkan ke dashboard admin
            return redirect()->route('admin.dashboard.index');

        } elseif ($user->isPemagang()) {
            return redirect()->route('pemagang.dashboard.index');

        } else {
            Auth::logout();

            return redirect('/login')->with('error', 'Peran Anda tidak valid atau tidak dikenali.');
        }
    }
}
