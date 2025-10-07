<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Internship extends Model
{
    protected $table = 'internship';

    protected $fillable = [
        'id_permohonan',
        'id_pembimbing',
        'status_magang',
    ];

    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(Permohonan::class, 'id_permohonan');
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Supervisor::class, 'id_pembimbing');
    }

    // relasi many-to-many ke peserta via pivot internship_participant
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(
            Participant::class,
            'internship_participant',
            'internship_id',
            'participant_id'
        )->withTimestamps();
    }

    public function logbooks(): HasMany
    {
        return $this->hasMany(Logbook::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
