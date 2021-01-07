<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'pesertas';
    protected $fillable = [
        'nipy', 'nama', 'status', 'jabatan', 'pendidikan', 'foto'
    ];
}
