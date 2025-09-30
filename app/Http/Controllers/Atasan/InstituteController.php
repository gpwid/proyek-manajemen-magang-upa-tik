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
                return view('atasan.instansi.actions', compact('p'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create()
    {
        return view('atasan.instansi.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
        ]);

        Institute::create($request->only([
            'nama_instansi', 'alamat',
        ]));

        return redirect()->route('atasan.instansi.index')->with('sukses', 'Data Disimpan');
    }

    public function edit(Institute $institute): View
    {
        return view('atasan.instansi.edit', compact('institute'));
    }

    public function update(Request $request, Institute $institute): RedirectResponse
    {
        $request->validate([
            'nama_instansi' => ['required', 'string', 'max:50', Rule::unique('institutes')->ignore($institute->id)],
            'alamat' => 'required|string|max:255',
        ]);

        $institute->update($request->only([
            'nama_instansi', 'alamat',
        ]));

        return redirect()->route('atasan.instansi.index')->with('sukses', 'Data berhasil diperbarui');
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

        $pdf = Pdf::loadView('atasan.instansi.pdf', compact('data', 'subtitle'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('institute_'.now()->format('Ymd_His').'.pdf');
    }
}
