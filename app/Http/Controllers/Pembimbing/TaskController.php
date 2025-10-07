<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\Participant;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Dapatkan internship aktif milik supervisor untuk peserta ini.
     * Hanya mengembalikan internship yang:
     * - id_pembimbing = supervisor login
     * - terhubung ke participant lewat pivot internship_participant
     * - (opsional) status_magang = 'Aktif'
     */
    protected function getActiveInternshipFor(Participant $participant)
    {
        $supervisor = Auth::user()->supervisor;

        return Internship::query()
            ->where('id_pembimbing', $supervisor->id)
            ->whereHas('participants', fn($q) => $q->where('participants.id', $participant->id))
            ->where(function ($q) {
                $q->where('status_magang', 'Aktif')->orWhereNull('status_magang');
            })
            ->latest('id')
            ->first();
    }

    /**
     * Cek akses: peserta harus berada dalam internship milik supervisor login.
     */
    protected function ensureAccess(Participant $participant): void
    {
        $supervisor = Auth::user()->supervisor;
        abort_unless($supervisor, 403, 'Akun ini tidak memiliki profil pembimbing.');

        $has = $participant->internships()
            ->where('internship.id_pembimbing', $supervisor->id)
            ->exists();

        abort_unless($has, 403, 'Anda tidak berwenang mengakses peserta ini.');
    }

    /**
     * List penugasan untuk peserta bimbingan.
     */
    public function index(Participant $participant)
    {
        $this->ensureAccess($participant);

        $tasks = Task::query()
            ->where('participant_id', $participant->id)
            ->whereHas('internship', function ($q) use ($participant) {
                // hanya task dari internship pembimbing login
                $q->where('id_pembimbing', Auth::user()->supervisor->id)
                  ->whereHas('participants', fn($p) => $p->where('participants.id', $participant->id));
            })
            ->latest('task_date')
            ->paginate(10);

        return view('pembimbing.task.index', compact('participant', 'tasks'));
    }

    /**
     * Form buat penugasan baru.
     */
    public function create(Participant $participant)
    {
        $this->ensureAccess($participant);

        $internship = $this->getActiveInternshipFor($participant);
        abort_unless($internship, 422, 'Tidak ditemukan internship aktif untuk peserta ini di bawah bimbingan Anda.');

        return view('pembimbing.task.create', compact('participant', 'internship'));
    }

    /**
     * Simpan penugasan baru.
     */
    public function store(Request $request, Participant $participant)
    {
        $this->ensureAccess($participant);

        $internship = $this->getActiveInternshipFor($participant);
        abort_unless($internship, 422, 'Tidak ditemukan internship aktif untuk peserta ini di bawah bimbingan Anda.');

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'task_date'   => ['required', 'date'],
            'status'      => ['required', 'in:Selesai,Dikerjakan,Revisi'],
            'feedback'    => ['nullable', 'string'],
        ]);

        $task = Task::create([
            'internship_id' => $internship->id,
            'participant_id'=> $participant->id,
            'title'         => $validated['title'],
            'description'   => $validated['description'] ?? null,
            'task_date'     => $validated['task_date'],
            'status'        => $validated['status'],
            'feedback'      => $validated['feedback'] ?? null,
        ]);

        return redirect()
            ->route('pembimbing.task.index', $participant)
            ->with('success', 'Penugasan berhasil dibuat.');
    }
}
