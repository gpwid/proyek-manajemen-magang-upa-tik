<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'keterangan',
    ];

    public function permohonan()
    {
        return $this->belongsTo(\App\Models\Permohonan::class, 'permohonan_id');
    }
}
