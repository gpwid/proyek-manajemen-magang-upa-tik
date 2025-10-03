<?php

namespace App\Http\Controllers\Pemagang;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class LogbookController extends Controller
{
    /**
     * Menampilkan daftar logbook milik pemagang.
     */
    public function index(): View
    {
        return view('pemagang.logbook.index');
    }

    public function data(Request $request)
    {
        $participant = Auth::user()->participant;
        // Eager load relasi 'task' untuk efisiensi query
        $query = Logbook::with('task')->where('participant_id', $participant->id);

        return DataTables::of($query)
            ->editColumn('date', function ($logbook) {
                return \Carbon\Carbon::parse($logbook->date)->translatedFormat('d F Y');
            })
            ->addColumn('related_task', function ($logbook) {
                // Tampilkan judul tugas jika ada, jika tidak tampilkan strip
                return $logbook->task ? $logbook->task->title : '-';
            })
            ->rawColumns(['tasks_completed'])
            ->make(true);
    }

    /**
     * Menampilkan form untuk membuat logbook baru.
     */
    public function create(): View
    {
        $participant = Auth::user()->participant;
        // Cek apakah hari ini sudah mengisi logbook
        $todayLogbook = Logbook::where('participant_id', Auth::user()->participant->id)
            ->where('date', now()->toDateString())
            ->exists();

        $tasks = Task::where('participant_id', $participant->id)
            ->whereIn('status', ['Dikerjakan', 'Revisi'])
            ->orderBy('title')
            ->get();

        return view('pemagang.logbook.create', compact('todayLogbook', 'tasks'));
    }

    /**
     * Menyimpan logbook baru.
     */
    // app/Http/Controllers/Pemagang/LogbookController.php

    public function store(Request $request): RedirectResponse
    {
        $participant = Auth::user()->participant;

        $request->validate([
            'date' => 'required|date|unique:logbooks,date,NULL,id,participant_id,'.$participant->id,
            'tasks_completed' => 'required|string',
            'description' => 'nullable|string',
            'task_id' => ['nullable', 'exists:tasks,id', function ($attribute, $value, $fail) use ($participant) {
                if ($value) { // Hanya validasi jika task_id dipilih
                    $taskExists = Task::where('id', $value)->where('participant_id', $participant->id)->exists();
                    if (! $taskExists) {
                        $fail('Tugas yang dipilih tidak valid.');
                    }
                }
            }],
        ]);

        $activeInternship = $participant->internships()->where('status_magang', 'Aktif')->first();
        if (! $activeInternship) {
            return back()->with('error', 'Anda tidak sedang dalam sesi magang yang aktif.')->withInput();
        }

        Logbook::create([
            'internship_id' => $activeInternship->id,
            'participant_id' => $participant->id,
            'task_id' => $request->task_id,
            'tasks_completed' => $request->tasks_completed,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        return redirect()->route('pemagang.logbook.index')->with('success', 'Logbook harian berhasil disimpan.');
    }
}
