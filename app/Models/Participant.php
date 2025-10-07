<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Participant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'permohonan_id',
        'nama',
        'nik',
        'nisnim',
        'jenis_kelamin',
        'jurusan',
        'kontak_peserta',
        'tahun_aktif',
        'status',
        'user_id',
        'keterangan',
        'supervisor_id',
        'email',
    ];

    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(Permohonan::class, 'permohonan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // many-to-many dengan internship lewat pivot internship_participant
    public function internships(): BelongsToMany
    {
        return $this->belongsToMany(
            Internship::class,
            'internship_participant',
            'participant_id',
            'internship_id'
        )->withTimestamps();
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function logbooks(): HasMany
    {
        return $this->hasMany(Logbook::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    // ==== TAMBAHAN: relasi ke Task (by participant_id) ====
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
