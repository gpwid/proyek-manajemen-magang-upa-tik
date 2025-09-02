<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class InstansiController extends Controller
{
    public function create(): View
    {
        $instans = \App\Models\Instansi::all();
        return view('admin.permohonan.tambah', compact('instans'));
    }
}
