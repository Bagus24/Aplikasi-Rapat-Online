<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validasiagenda extends Model
{
    protected $table = 'validasiagenda';
    protected $fillable = [
        'tanggal','mulai', 'selesai', 'peserta', 'kode',
    ];
}
