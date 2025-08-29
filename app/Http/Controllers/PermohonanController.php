<?php

namespace App\Http\Controllers;
use Illuminate\View\View;

use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function index(): View
    {
        return view('admin.permohonan.index');
    }

    public function create(): View
    {
        $instans = \App\Models\Instansi::all();
        return view('admin.permohonan.tambah', compact('instans'));
    }
}
