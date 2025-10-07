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

    protected function ensureAccess(Participant $participant): void
    {
        $supervisor = Auth::user()->supervisor;
        abort_unless($supervisor, 403, 'Akun ini tidak memiliki profil pembimbing.');

        $has = $participant->internships()
            ->where('internship.id_pembimbing', $supervisor->id)
            ->exists();

        abort_unless($has, 403, 'Anda tidak berwenang mengakses peserta ini.');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $supervisor = $user->supervisor;
        abort_unless($supervisor, 403, 'Akun ini tidak memiliki profil pembimbing.');

        $q = trim((string) $request->get('q'));

        $participants = Participant::query()
            // peserta yg terhubung dgn internship milik supervisor (id_pembimbing)
            ->whereHas('internships', function ($iq) use ($supervisor) {
                $iq->where('internship.id_pembimbing', $supervisor->id);
            })
            // hitung ringkasan
            ->withCount([
                'tasks as tasks_count' => function ($tq) use ($supervisor) {
                    $tq->whereHas('internship', fn($iq) => $iq->where('id_pembimbing', $supervisor->id));
                },
                'logbooks as logbooks_count',
                'attendances as attendances_count',
            ])
            // pencarian
            ->when($q !== '', function ($qry) use ($q) {
                $qry->where(function ($w) use ($q) {
                    $w->where('nama', 'like', "%{$q}%")
                      ->orWhere('nisnim', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%");
                });
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('pembimbing.task.participants', [
            'participants' => $participants,
            'q'            => $q,
        ]);
    }

    public function create(Participant $participant)
    {
        $this->ensureAccess($participant);
        $internship = $this->getActiveInternshipFor($participant);
        abort_unless($internship, 422, 'Tidak ada internship aktif untuk peserta ini.');

        return view('pembimbing.task.create', compact('participant', 'internship'));
    }

    public function store(Request $request, Participant $participant)
    {
        $this->ensureAccess($participant);
        $internship = $this->getActiveInternshipFor($participant);
        abort_unless($internship, 422, 'Tidak ada internship aktif untuk peserta ini.');

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'task_date'   => ['required', 'date'],
            'status'      => ['required', 'in:Selesai,Dikerjakan,Revisi'],
            'feedback'    => ['nullable', 'string'],
        ]);

        Task::create([
            'internship_id' => $internship->id,
            'participant_id'=> $participant->id,
            'title'         => $validated['title'],
            'description'   => $validated['description'] ?? null,
            'task_date'     => $validated['task_date'],
            'status'        => $validated['status'],
            'feedback'      => $validated['feedback'] ?? null,
        ]);

        return redirect()->route('pembimbing.task.index', $participant)
            ->with('success', 'Task berhasil dibuat.');
    }

    public function edit(Participant $participant, Task $task)
    {
        $this->ensureAccess($participant);

        // pastikan task memang milik participant & supervisor login
        abort_unless(
            $task->participant_id === $participant->id
            && $task->internship
            && $task->internship->id_pembimbing === Auth::user()->supervisor->id,
            403,
            'Anda tidak berhak mengedit task ini.'
        );

        return view('pembimbing.task.edit', compact('participant', 'task'));
    }

    public function update(Request $request, Participant $participant, Task $task)
    {
        $this->ensureAccess($participant);

        abort_unless(
            $task->participant_id === $participant->id
            && $task->internship
            && $task->internship->id_pembimbing === Auth::user()->supervisor->id,
            403,
            'Anda tidak berhak mengubah task ini.'
        );

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'task_date'   => ['required', 'date'],
            'status'      => ['required', 'in:Selesai,Dikerjakan,Revisi'],
            'feedback'    => ['nullable', 'string'],
        ]);

        $task->update($validated);

        return redirect()->route('pembimbing.task.index', $participant)
            ->with('success', 'Task berhasil diperbarui.');
    }

    public function destroy(Participant $participant, Task $task)
    {
        $this->ensureAccess($participant);

        abort_unless(
            $task->participant_id === $participant->id
            && $task->internship
            && $task->internship->id_pembimbing === Auth::user()->supervisor->id,
            403,
            'Anda tidak berhak menghapus task ini.'
        );

        $task->delete();

        return redirect()->route('pembimbing.task.index', $participant)
            ->with('success', 'Task berhasil dihapus.');
    }
}
