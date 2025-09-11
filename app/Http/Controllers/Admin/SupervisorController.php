<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supervisor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SupervisorsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\View\View;

class SupervisorController extends Controller
{
    public function index()
    {
        return view('admin.pembimbing.index');
    }

    public function data(Request $request)
    {
        $query = Supervisor::query();

        // Filter Search Custom
        if ($request->searchbox) {
            $search = $request->searchbox;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($p) {
                return view('admin.pembimbing.actions', compact('p'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.pembimbing.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'nip' => 'required|string|max:30|unique:supervisors,nip',
        ]);

        Supervisor::create($request->only([
            'nama','nip'
        ]));

        return redirect()->route('admin.pembimbing.index')->with('sukses', 'Data Disimpan');
    }

    public function edit(Supervisor $supervisor): View
    {
        return view('admin.pembimbing.edit', compact('supervisor'));
    }

    public function update(Request $request, Supervisor $supervisor): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'nip' => 'required|string|max:30|unique:supervisors,nip,'.$supervisor->id,
        ]);

        $supervisor->update($request->only([
            'nama','nip'
        ]));

        return redirect()->route('admin.pembimbing.index')->with('sukses', 'Data berhasil diperbarui');
    }

    public function exportExcel(Request $request)
    {
        $filename = 'pembimbing_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new SupervisorsExport($request), $filename);
    }

    public function exportPdf(Request $request)
    {
        $q = Supervisor::query();

        if ($search = $request->get('search')) {
            $q->where(function($x) use ($search) {
                $x->where('nama','like',"%{$search}%")
                  ->orWhere('nip','like',"%{$search}%");
            });
        }

        $data = $q->orderBy('nama')->get();
        $subtitle = '';
        if ($search) {
            $subtitle = 'Hasil pencarian untuk: "' . $search . '"';
        }

        $pdf = Pdf::loadView('admin.pembimbing.pdf', compact('data','subtitle'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('supervisor_'.now()->format('Ymd_His').'.pdf');
    }
}
