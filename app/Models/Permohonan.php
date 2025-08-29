<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'id_instansi',
        'tgl_surat',
        'instansi',
        'tgl_mulai',
        'tgl_selesai',
        'pembimbing_sekolah',
        'kontak_pembimbing',
        'tgl_suratmasuk',
        'jenis_magang',
        'status',
        'file_permohonan',
    ];

    public function user()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi');
    }
}
