<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    protected $fillable = [
        'kode','pesan', 'tanggal', 'nama_peserta', 'status',
    ];
}
