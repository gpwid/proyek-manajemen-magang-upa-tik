<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute; // Penting: Import ini
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'date',
        'status',
        'note',
        'recorded_by',
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

    /**
     * Accessor: Check In Time
     * Otomatis mengubah waktu dari UTC (Database) ke Asia/Jakarta saat dipanggil ($attendance->check_in_time).
     */
    protected function checkInTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->setTimezone('Asia/Jakarta') : null,
        );
    }

    /**
     * Accessor: Check Out Time
     * Otomatis mengubah waktu dari UTC (Database) ke Asia/Jakarta saat dipanggil ($attendance->check_out_time).
     */
    protected function checkOutTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->setTimezone('Asia/Jakarta') : null,
        );
    }

    // --- RELASI ---

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

    public function recorder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}