<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supervisor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'nama',
        'nip',
        'email',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // internship yang dipegang supervisor ini
    public function internships(): HasMany
    {
        return $this->hasMany(Internship::class, 'id_pembimbing');
    }
}
