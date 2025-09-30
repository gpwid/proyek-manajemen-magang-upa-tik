<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'tahun_aktif',
        'status',
        'user_id',
        'keterangan',
    ];

    public function permohonan()
    {
        return $this->belongsTo(\App\Models\Permohonan::class, 'permohonan_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
