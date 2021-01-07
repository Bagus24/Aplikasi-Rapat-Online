<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifikasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode', 12);
            $table->string('pesan', 40);
            $table->string('tanggal', 20);
            $table->string('nama_peserta', 40);
            $table->enum('status', ['baru', 'lama']);
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
        Schema::dropIfExists('notifikasi');
    }
}
