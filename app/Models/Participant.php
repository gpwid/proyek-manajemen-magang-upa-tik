<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'nama',
        'nik',
        'nisnim',
        'jenis_kelamin',
        'jurusan',
        'kontak_peserta',
        'keterangan',
    ];
}
