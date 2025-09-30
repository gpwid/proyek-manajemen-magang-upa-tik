<?php

namespace App\Http\Controllers\Admin;

use App\Exports\InstitutesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstituteRequest;
use App\Http\Requests\UpdateInstituteRequest;
use App\Models\Institute;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class InstituteController extends Controller
{
    public function index()
    {
        return view('admin.instansi.index');
    }

    public function data(Request $request)
    {
        $query = Institute::query();

        // Filter Search Custom
        if ($request->searchbox) {
            $search = $request->searchbox;
            $query->where(function ($q) use ($search) {
                $q->where('nama_instansi', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($p) {
                return "<div class='flex gap-2'>
                <a href='".route('admin.instansi.edit', $p->id)."'
                   class='btn btn-sm btn-primary text-white'
                   data-bs-toggle='tooltip'
                   data-bs-placement='top'
                   title='Edit'>
                    <i class='fa-solid fa-pen-to-square'></i> Edit
                </a>
                <a href='".route('admin.instansi.show', $p->id)."'
                   class='btn btn-sm btn-info text-white'
                   data-bs-toggle='tooltip'
                   data-bs-placement='top'
                   title='Detail'>
                    <i class='fa-solid fa-eye'></i> Detail
                </a>
            </div>";
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.instansi.create');
    }

    public function store(StoreInstituteRequest $request): RedirectResponse
    {
        Institute::create($request->validated());

        return redirect()->route('admin.instansi.index')->with('sukses', 'Data Disimpan');
    }

    public function edit(Institute $institute): View
    {
        return view('admin.instansi.edit', compact('institute'));
    }

    public function update(UpdateInstituteRequest $request, Institute $institute): RedirectResponse
    {
        $institute->update($request->validated());

        return redirect()->route('admin.instansi.index')->with('sukses', 'Data berhasil diperbarui');
    }

    public function exportExcel(Request $request)
    {
        $filename = 'institute_'.now()->format('Ymd_His').'.xlsx';

        return Excel::download(new InstitutesExport($request), $filename);
    }

    public function exportPdf(Request $request)
    {
        $q = Institute::query();

        if ($search = $request->get('search')) {
            $q->where(function ($x) use ($search) {
                $x->where('nama_instansi', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        $data = $q->orderBy('nama_instansi')->get();
        $subtitle = '';
        if ($search) {
            $subtitle = 'Hasil pencarian untuk: "'.$search.'"';
        }

        $pdf = Pdf::loadView('admin.instansi.pdf', compact('data', 'subtitle'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('institute_'.now()->format('Ymd_His').'.pdf');
    }
}
