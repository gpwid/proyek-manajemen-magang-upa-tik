<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'nama',
        'nip',
    ];
}