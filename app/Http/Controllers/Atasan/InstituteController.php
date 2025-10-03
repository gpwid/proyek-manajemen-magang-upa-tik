<?php

namespace App\Http\Controllers\Atasan;

use App\Exports\InstitutesExport;
use App\Http\Controllers\Controller;
use App\Models\Institute;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class InstituteController extends Controller
{
    public function index()
    {
        return view('atasan.instansi.index');
    }

    public function data(Request $request)
    {
        $query = Institute::query()
            ->select(['id', 'nama_instansi', 'alamat']); // aman & eksplisit

        // Filter Search Custom (dari input "searchbox")
        if ($request->filled('searchbox')) {
            $search = $request->string('searchbox');
            $query->where(function ($q) use ($search) {
                $q->where('nama_instansi', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Kembalikan JSON untuk DataTables
        return DataTables::of($query)
            ->addIndexColumn() // DT_RowIndex
            ->make(true);
    }

    public function exportExcel(Request $request)
    {
        // Samakan: pakai 'searchbox' agar konsisten dengan front-end
        $filename = 'institute_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new InstitutesExport($request), $filename);
    }

    public function exportPdf(Request $request)
    {
        $q = Institute::query();

        // Samakan: ambil dari 'searchbox'
        $search = $request->get('searchbox');
        if (!empty($search)) {
            $q->where(function ($x) use ($search) {
                $x->where('nama_instansi', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        $data = $q->orderBy('nama_instansi')->get();
        $subtitle = $search ? 'Hasil pencarian untuk: "' . $search . '"' : '';

        $pdf = Pdf::loadView('atasan.instansi.pdf', compact('data', 'subtitle'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('institute_' . now()->format('Ymd_His') . '.pdf');
    }
}
