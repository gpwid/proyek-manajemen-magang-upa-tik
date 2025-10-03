<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'internship_id',
        'participant_id',
        'task_id',
        'tasks_completed',
        'date',
        'description',
    ];

    public function internship()
    {
        return $this->belongsTo(Internship::class, 'internship_id');
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
