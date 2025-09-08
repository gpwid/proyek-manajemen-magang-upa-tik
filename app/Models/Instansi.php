<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $guarded = ['id'];
    protected $table = 'instansi';

    protected $fillable = [
        'nama_instansi',
        'alamat',
    ];
}
