<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ParticipantController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $user = Auth::user();
        $supervisor = $user->supervisor;
        abort_unless($supervisor, 403, 'Akun ini tidak memiliki profil pembimbing.');

        $q = trim((string) $request->get('q'));

        $participants = Participant::query()
            // peserta yg terhubung ke internship milik supervisor login
            ->whereHas('internships', function ($iq) use ($supervisor) {
                $iq->where('internship.id_pembimbing', $supervisor->id);
            })
            ->withCount(['logbooks', 'attendances'])
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

        return view('pembimbing.peserta.index', [
            'participants' => $participants,
            'q' => $q,
        ]);
    }

    public function show(Participant $participant)
    {
        $this->authorize('view', $participant);

        $participant->load([
            // ambil internship-nya (untuk info pembimbing)
            'internships.supervisor',
            // data detail
            'logbooks'    => fn($q) => $q->latest('date'),
            'attendances' => fn($q) => $q->latest('date'),
        ]);

        return view('pembimbing.peserta.show', compact('participant'));
    }
}
