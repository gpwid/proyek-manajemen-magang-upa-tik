<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'nama_instansi',
        'alamat',
    ];
}
