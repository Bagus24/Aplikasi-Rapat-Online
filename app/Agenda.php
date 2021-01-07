<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'agenda';
    protected $fillable = [
        'jenis', 'pembahasan', 'tanggal', 'mulai', 'selesai', 'kode', 'bulan', 'tahun', 'peserta','nama_peserta', 'pimpinan'
    ];
}
