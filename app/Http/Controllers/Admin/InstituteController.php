<?php

namespace App\Http\Controllers\Admin;

use App\Models\Institute;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InstitutesExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\View\View;

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
            $query->where(function($q) use ($search) {
                $q->where('nama_instansi', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($p) {
                return view('admin.instansi.actions', compact('p'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.instansi.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
        ]);

        Institute::create($request->only([
            'nama_instansi','alamat'
        ]));

        return redirect()->route('admin.instansi.index')->with('sukses', 'Data Disimpan');
    }

    public function edit(Institute $institute): View
    {
        return view('admin.instansi.edit', compact('institute'));
    }

    public function update(Request $request, Institute $institute): RedirectResponse
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:50',
            'alamat' => 'required|string|max:255|'.$institute->id,
        ]);

        $institute->update($request->only([
            'nama_instansi','alamat'
        ]));

        return redirect()->route('admin.instansi.index')->with('sukses', 'Data berhasil diperbarui');
    }

    public function exportExcel(Request $request)
    {
        $filename = 'institute_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new InstitutesExport($request), $filename);
    }

    public function exportPdf(Request $request)
    {
        $q = Institute::query();

        if ($search = $request->get('search')) {
            $q->where(function($x) use ($search) {
                $x->where('nama_instansi','like',"%{$search}%")
                  ->orWhere('alamat','like',"%{$search}%");
            });
        }

        $data = $q->orderBy('nama_instansi')->get();
        $subtitle = '';
        if ($search) {
            $subtitle = 'Hasil pencarian untuk: "' . $search . '"';
        }

        $pdf = Pdf::loadView('admin.instansi.pdf', compact('data','subtitle'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('institute_'.now()->format('Ymd_His').'.pdf');
    }
}
