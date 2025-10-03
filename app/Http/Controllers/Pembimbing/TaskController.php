<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTugasRequest;
use App\Models\Participant;
use App\Models\Supervisor;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Pastikan participant ini memang dibina oleh pembimbing (user) yang login.
     * Di sini asumsi mapping: supervisors.user_id -> users.id
     * dan participants.supervisor_id -> supervisors.id
     */
    protected function ensureMentorOwns(Participant $participant, int $userId): void
    {
        $supervisorId = Supervisor::where('user_id', $userId)->value('id');
        abort_unless($supervisorId && (int)$participant->supervisor_id === (int)$supervisorId, 403, 'Anda tidak memiliki akses ke peserta ini.');
    }

    public function index(Request $request, Participant $participant)
    {
        $this->ensureMentorOwns($participant, $request->user()->id);

        $tasks = Task::where('participant_id', $participant->id)
            ->latest()
            ->paginate(10);

        return view('pembimbing.task.index', compact('participant', 'tasks'));
    }

    public function create(Request $request, Participant $participant)
    {
        $this->ensureMentorOwns($participant, $request->user()->id);

        // Ambil daftar internship yang TERKAIT ke participant via pivot internship_participant
        // Tabel utama: internship (singular sesuai migrasi kamu)
        $internships = DB::table('internship')
            ->join('internship_participant', 'internship_participant.internship_id', '=', 'internship.id')
            ->where('internship_participant.participant_id', $participant->id)
            ->orderByDesc('internship.id')
            ->get(['internship.id']);

        return view('pembimbing.task.create', compact('participant', 'internships'));
    }

    public function store(StoreTugasRequest $request, Participant $participant)
    {
        $this->ensureMentorOwns($participant, $request->user()->id);

        DB::transaction(function () use ($request, $participant) {
            Task::create([
                'internship_id' => $request->validated('internship_id'),
                'participant_id'=> $participant->id,
                'title'         => $request->validated('title'),
                'description'   => $request->validated('description'), // wajib (migrasi kamu NOT NULL)
                'task_date'     => $request->validated('task_date'),   // wajib (migrasi kamu NOT NULL)
                'status'        => $request->validated('status', 'Dikerjakan'),
                'feedback'      => $request->validated('feedback'),
            ]);
        });

        return redirect()
            ->route('pembimbing.task.index', $participant)
            ->with('success', 'Tugas berhasil dibuat.');
    }
}
