<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'date',
        'status',      // <-- NEW
        'note',        // <-- NEW
        'recorded_by', // <-- NEW
        'check_in_time',
        'check_in_ip_address',
        'check_out_time',
        'check_out_ip_address',
    ];

    protected $casts = [
        'date' => 'date',
        'check_in_time'  => 'datetime',
        'check_out_time' => 'datetime',
    ];

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

    public function recorder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
