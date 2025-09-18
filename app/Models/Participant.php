<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
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
