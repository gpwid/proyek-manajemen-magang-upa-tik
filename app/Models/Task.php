<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $guarded = ['id'];

    protected $table = 'tasks';

    protected $casts = [
        'task_date' => 'date',
    ];

    protected $fillable = [
        'internship_id',
        'participant_id',
        'title',
        'description',
        'task_date',
        'status',
        'feedback',
    ];

    public function internship(): BelongsTo
    {
        return $this->belongsTo(Internship::class);
    }

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class);
    }
}
