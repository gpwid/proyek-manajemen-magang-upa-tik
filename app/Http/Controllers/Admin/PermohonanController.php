<?php

namespace App\Http\Controllers\Admin;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permohonan;
use App\Models\Instansi;

class PermohonanController extends Controller
{
    public function index(Request $request) : View
    {
        $searchinstansis = Instansi::orderBy('nama_instansi')->get();

        $query = Permohonan::query();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('instansi', 'like', "%$q%");
            $query->orWhere('pembimbing_sekolah', 'like', "%$q%");
            $query->orWhere('kontak_pembimbing', 'like', "%$q%");
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('instansi')) {
            $query->where('instansi', $request->instansi);
        }

        $sortDate = $request->input('sort_date', 'desc');
        $query->orderBy('tgl_surat', $sortDate === 'asc' ? 'asc' : 'desc');

        $permohonan = $query->paginate(10)->withQueryString();

        $totalAktif = Permohonan::where('status', 'Aktif')->count();
        $totalTolak = Permohonan::where('status', 'Ditolak')->count();
        $totalProses = Permohonan::where('status', 'Proses')->count();
        $totalSelesai = Permohonan::where('status', 'Selesai')->count();
        $totalSemua = Permohonan::count();

        return view('admin.permohonan.index', compact(
            'searchinstansis', 'permohonan', 'totalAktif', 'totalTolak', 'totalProses', 'totalSemua', 'totalSelesai',
        ));
    }

}

