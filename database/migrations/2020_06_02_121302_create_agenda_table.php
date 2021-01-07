<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jenis', 20);
            $table->string('pembahasan', 100);
            $table->string('tanggal', 20);
            $table->string('mulai', 10);
            $table->string('selesai', 10);
            $table->string('kode', 12);
            $table->string('bulan', 10);
            $table->string('tahun', 10);
            $table->text('peserta');
            $table->text('nama_peserta');
            $table->string('pimpinan', 40);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agenda');
    }
}
