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
        'file_permohonan_nama_asli',
        'file_permohonan_size',
        'file_permohonan_mime',
    ];

    public function user()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi');
    }

    public function Instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi');
    }
}
