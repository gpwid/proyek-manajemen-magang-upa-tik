<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $guarded = ['id'];

    protected $table = 'permohonan';

    protected $casts = [
        'tgl_surat' => 'date',
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date',
        'tgl_suratmasuk' => 'date',
    ];

    protected $fillable = [
        'id_institute',
        'no_surat',
        'tgl_surat',
        'tgl_mulai',
        'tgl_selesai',
        'pembimbing_sekolah',
        'kontak_pembimbing',
        'tgl_suratmasuk',
        'jenis_magang',
        'status',
        'file_permohonan',
        'file_permohonan_nama_asli',
        'file_permohonan_size',
        'file_permohonan_mime',
    ];

    public function participants()
    {
        return $this->hasMany(\App\Models\Participant::class, 'permohonan_id');
    }

    public function institute()
    {
        return $this->belongsTo(\App\Models\Institute::class, 'id_institute');
    }
}
