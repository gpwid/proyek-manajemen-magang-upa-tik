<?php

namespace App\Models;

use App\Models\Supervisor as ModelsSupervisor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Internship extends Model
{
    protected $guarded = ['id'];

    protected $table = 'internship';

    protected $fillable = [
        'id_supervisor',
        'id_permohonan',
        'status_magang',
    ];

    public function Permohonan()
    {
        return $this->belongsTo(Permohonan::class, 'id_permohonan');
    }

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class, 'internship_id');
    }
}
