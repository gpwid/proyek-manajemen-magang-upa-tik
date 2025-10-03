<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Supervisor;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        // Ambil supervisor berdasar akun login
        $supervisor = Supervisor::where('user_id', $userId)->firstOrFail();

        $mentees = Participant::query()
            ->where('supervisor_id', $supervisor->id)
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = (string) $request->get('q');
                $q->where(function ($w) use ($term) {
                    $w->where('nama', 'like', "%{$term}%")
                      ->orWhere('nisnim', 'like', "%{$term}%")
                      ->orWhere('jurusan', 'like', "%{$term}%");
                });
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('pembimbing.participant.index', compact('mentees'));
    }
}
