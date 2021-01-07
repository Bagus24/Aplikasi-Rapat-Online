<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidasiagendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validasiagenda', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tanggal', 20);
            $table->string('mulai', 10);
            $table->string('selesai', 10);
            $table->string('peserta', 40);
            $table->string('kode', 12);
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
        Schema::dropIfExists('validasiagenda');
    }
}
