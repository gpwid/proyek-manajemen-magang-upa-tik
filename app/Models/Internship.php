<?php

namespace App\Models;

use App\Models\Supervisor as ModelsSupervisor;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    protected $guarded = ['id'];
    protected $table = 'internship';

    protected $fillable = [
        'id_pembimbing',
        'id_permohonan',
        'id_peserta',
        'status_magang',
    ];

    public function Supervisor()
    {
        return $this->belongsTo(ModelsSupervisor::class, 'id_pembimbing');
    }

    public function Permohonan()
    {
        return $this->belongsTo(Permohonan::class, 'id_permohonan');
    }

    public function Participant()
    {
        return $this->belongsTo(Participant::class, 'id_peserta');
    }
}
