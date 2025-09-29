<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SupervisorsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupervisorRequest;
use App\Http\Requests\UpdateSupervisorRequest;
use App\Models\Supervisor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

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
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($p) {
                return "<div class='flex gap-2'>
                <a href='".route('admin.pembimbing.edit', $p->id)."'
                   class='btn btn-sm btn-primary text-white'
                   data-bs-toggle='tooltip'
                   data-bs-placement='top'
                   title='Edit'>
                    <i class='fa-solid fa-pen-to-square'></i> Edit
                </a>
                <a href='".route('admin.pembimbing.show', $p->id)."'
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
        return view('admin.pembimbing.create');
    }

    public function store(StoreSupervisorRequest $request): RedirectResponse
    {
        Supervisor::create($request->validated());

        return redirect()->route('admin.pembimbing.index')->with('sukses', 'Data Disimpan');
    }

    public function edit(Supervisor $supervisor): View
    {
        return view('admin.pembimbing.edit', compact('supervisor'));
    }

    public function update(UpdateSupervisorRequest $request, Supervisor $supervisor): RedirectResponse
    {
        $supervisor->update($request->validated());

        return redirect()->route('admin.pembimbing.index')->with('sukses', 'Data berhasil diperbarui');
    }

    public function exportExcel(Request $request)
    {
        $filename = 'pembimbing_'.now()->format('Ymd_His').'.xlsx';

        return Excel::download(new SupervisorsExport($request), $filename);
    }

    public function exportPdf(Request $request)
    {
        $q = Supervisor::query();

        if ($search = $request->get('search')) {
            $q->where(function ($x) use ($search) {
                $x->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        $data = $q->orderBy('nama')->get();
        $subtitle = '';
        if ($search) {
            $subtitle = 'Hasil pencarian untuk: "'.$search.'"';
        }

        $pdf = Pdf::loadView('admin.pembimbing.pdf', compact('data', 'subtitle'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('supervisor_'.now()->format('Ymd_His').'.pdf');
    }
}
