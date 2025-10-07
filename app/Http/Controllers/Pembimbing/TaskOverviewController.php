<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskOverviewController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $supervisor = $user->supervisor;
        abort_unless($supervisor, 403, 'Akun ini tidak memiliki profil pembimbing.');

        $q = trim((string) $request->get('q'));

        // Ambil peserta yang terhubung dengan internship milik supervisor login
        $participants = Participant::query()
            ->whereHas('internships', function ($iq) use ($supervisor) {
                $iq->where('internship.id_pembimbing', $supervisor->id);
            })
            // hitung jumlah task utk peserta ini DI bawah internship supervisor login
            ->withCount([
                'tasks as tasks_count' => function ($tq) use ($supervisor) {
                    $tq->whereHas('internship', fn($iq) => $iq->where('id_pembimbing', $supervisor->id));
                },
                'logbooks as logbooks_count',
                'attendances as attendances_count',
            ])
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
}
