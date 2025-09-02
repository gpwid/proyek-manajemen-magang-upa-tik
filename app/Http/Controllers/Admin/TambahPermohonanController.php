<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TambahPermohonanController extends Controller
{
    public function index()
    {
        $tempatinstansis = \App\Models\Instansi::all();
        return view('admin.permohonan.tambah', compact('tempatinstansis'));
    }

}
