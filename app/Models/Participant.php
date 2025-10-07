<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'permohonan_id',
        'nama',
        'nik',
        'nisnim',
        'email',
        'jenis_kelamin',
        'jurusan',
        'kontak_peserta',
        'institute_id',
        'alamat_asal',
        'nama_wali',
        'kontak_wali',
        'tahun_aktif',
        'status',
        'user_id',
        'keterangan',
        'supervisor_id',
    ];

    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Permohonan::class, 'permohonan_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function internships()
    {
        return $this->belongsToMany(Internship::class, 'internship_participant', 'participant_id', 'internship_id');
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }
}
