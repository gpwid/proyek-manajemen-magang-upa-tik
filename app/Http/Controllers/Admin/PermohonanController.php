<?php

namespace App\Http\Controllers\Admin;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function index()
    {
        return view('admin.permohonan.index');
    }

    public function create(): View
    {
        $instans = \App\Models\Instansi::all();
        return view('admin.permohonan.tambah', compact('instans'));
    }
}

