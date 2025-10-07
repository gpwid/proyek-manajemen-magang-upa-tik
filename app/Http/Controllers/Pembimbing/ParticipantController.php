<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ParticipantController extends Controller
{
    use AuthorizesRequests;
    // List peserta bimbingan - ambil dari tabel internships yang 'active'
    public function index(Request $request)
    {
        $user = Auth::user();
        $supervisor = $user->supervisor;
        abort_unless($supervisor, 403, 'Akun ini tidak memiliki profil pembimbing.');

        $q = $request->get('q');

        $internships = Internship::query()
            ->with(['participant' => function ($p) {
                $p->withCount(['logbooks', 'attendances']);
            }])
            ->where('supervisor_id', $supervisor->id)
            ->when($q, function ($query) use ($q) {
                $query->whereHas('participant', function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('student_id', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%");
                });
            })
            ->where(function ($st) {
                // sesuaikan: logika status aktif; kalau tidak ada, hapus where ini
                $st->where('status', 'active')->orWhereNull('status');
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('pembimbing.peserta.index', compact('internships', 'q'));
    }

    // Detail peserta (logbook & absen) - authorized via policy (cek ada internship miliknya)
    public function show(Participant $participant)
    {
        $this->authorize('view', $participant);

        $participant->load([
            'supervisor.user', // opsional
            'logbooks' => fn ($q) => $q->latest(),
            'attendances' => fn ($q) => $q->latest(),
            'internships' => fn ($q) => $q->latest(),
        ]);

        return view('pembimbing.peserta.show', compact('participant'));
    }
}
