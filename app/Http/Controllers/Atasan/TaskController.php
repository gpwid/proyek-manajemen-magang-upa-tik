<?php

namespace App\Http\Controllers\Atasan;

use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Internship;
use App\Models\Participant;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('participant', 'internship.permohonan.institute')->get();

        $groupedTasks = $tasks->groupBy('status');

        $kanbanColumns = [
            'Dikerjakan' => $groupedTasks->get('Dikerjakan', collect()),
            'Revisi' => $groupedTasks->get('Revisi', collect()),
            'Selesai' => $groupedTasks->get('Selesai', collect()),
        ];

        $institutes = Institute::orderBy('nama_instansi')->get();

        return view('atasan.penugasan.index', compact('kanbanColumns', 'institutes'));
    }

    public function data(Request $request)
    {
        // PERBAIKAN: Muat relasi yang benar
        $query = Task::with(['participant', 'internship.permohonan.institute']);

        return DataTables::of($query)
            ->addColumn('participant_name', fn ($task) => $task->participant->nama ?? '-')
            // PERBAIKAN: Ambil nama instansi dari jalur relasi yang benar
            ->addColumn('institute_name', fn ($task) => $task->internship->permohonan->institute->nama_instansi ?? '-')
            ->editColumn('task_date', fn ($task) => $task->task_date->format('d M Y'))
            ->editColumn('status', function ($task) {
                $cls = match ($task->status) {
                    'Selesai' => 'bg-success',
                    'Dikerjakan' => 'bg-info',
                    'Revisi' => 'bg-warning',
                    default => 'bg-secondary',
                };

                return "<span class='badge {$cls} text-white'>{$task->status}</span>";
            })
            ->addColumn('actions', function ($task) {
                $url1 = route('atasan.penugasan.edit', $task->id);
                $url2 = route('atasan.penugasan.show', $task->id);

                return "<div class='flex gap-2'>
                    <a href='{$url2}' class='btn btn-sm btn-success text-white'><i class='fa-solid fa-eye'></i> Detail</a>
                </div>";
            })
            ->filter(function ($query) use ($request) {
                if ($request->filled('institute_id')) {
                    $query->whereHas('internship.permohonan', function ($q) use ($request) {
                        $q->where('id_institute', $request->institute_id);
                    });
                }
                if ($request->filled('status')) {
                    $query->where('status', $request->status);
                }
                if ($request->has('search') && $request->search['value'] != '') {
                    $keyword = $request->search['value'];
                    $query->where(function ($q) use ($keyword) {
                        $q->where('title', 'like', "%{$keyword}%")
                            ->orWhereHas('participant', function ($subq) use ($keyword) {
                                $subq->where('nama', 'like', "%{$keyword}%");
                            });
                    });
                }
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function show(Task $task): View
    {
        // Muat semua relasi yang diperlukan untuk ditampilkan di halaman detail
        $task->load(['participant', 'internship.supervisor', 'internship.permohonan.institute']);

        return view('atasan.penugasan.show', compact('task'));
    }
}
