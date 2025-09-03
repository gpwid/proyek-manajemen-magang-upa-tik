<?php

namespace App\Http\Controllers\Admin;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function index()
    {
        $searchinstansis = \App\Models\Instansi::all();
        $permohonan = \App\Models\Permohonan::all();
        return view('admin.permohonan.index', compact('searchinstansis', 'permohonan'));
    }

}

