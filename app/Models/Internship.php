<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Supervisor as ModelsSupervisor;

class Internship extends Model
{
    protected $guarded = ['id'];
    protected $table = 'internship';

    protected $fillable = [
        'id_pembimbing',
        'id_permohonan',
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

    public function Participants()
    {
        return $this->belongsToMany(Participant::class, 'internship_participant');
    }
}
