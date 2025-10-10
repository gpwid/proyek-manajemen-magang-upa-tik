<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ManualAttendanceController extends Controller
{
    /**
     * Form input absensi manual (Izin/Sakit).
     * Bisa dipanggil tanpa / dengan participant_id (preselect).
     */
    public function create(Request $request): View
    {
        $participants = Participant::where('status', 'approved')
            ->orderBy('nama')->get(['id','nama','nisnim']);

        $selectedParticipantId = $request->query('participant_id');

        return view('admin.attendance.manual', compact('participants', 'selectedParticipantId'));
    }

    /**
     * Simpan absensi manual. Tidak akan menimpa absensi yang sudah "Hadir" (punya check-in/out).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'date'           => 'required|date',
            'status'         => 'required|in:Izin,Sakit', // khusus 2 ini sesuai requirement
            'note'           => 'required|string|max:255',
        ], [], [
            'participant_id' => 'Peserta',
            'date'           => 'Tanggal',
            'status'         => 'Status',
            'note'           => 'Keterangan',
        ]);

        // Cegah menimpa absensi hadir yang sudah ada (punya check-in/check-out)
        $existing = Attendance::where('participant_id', $validated['participant_id'])
            ->whereDate('date', $validated['date'])
            ->first();

        if ($existing && ($existing->check_in_time || $existing->check_out_time)) {
            return back()->withErrors('Tidak dapat mengubah: peserta sudah memiliki absensi hadir pada tanggal tersebut.');
        }

        // Buat / update baris absensi tanggal itu menjadi Izin/Sakit
        $attendance = Attendance::updateOrCreate(
            [
                'participant_id' => $validated['participant_id'],
                'date'           => $validated['date'],
            ],
            [
                'status'               => $validated['status'],
                'note'                 => $validated['note'],
                'recorded_by'          => Auth::id(),
                'check_in_time'        => null,
                'check_in_ip_address'  => null,
                'check_out_time'       => null,
                'check_out_ip_address' => null,
            ]
        );

        return redirect()
            ->route('admin.peserta.show', $validated['participant_id'])
            ->with('success', "Absensi {$validated['status']} pada {$attendance->date->format('d-m-Y')} berhasil disimpan.");
    }
}
