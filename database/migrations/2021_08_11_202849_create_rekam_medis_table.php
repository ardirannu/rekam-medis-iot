<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamMedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kartu_pasien_id');
            $table->foreign('kartu_pasien_id')->references('id')->on('kartu_pasien');
            $table->foreignId('dokter_id');
            $table->foreign('dokter_id')->references('id')->on('dokter');
            $table->string('keluhan');
            $table->string('diagnosa');
            $table->string('obat_id');
            $table->foreignId('poliklinik_id');
            $table->foreign('poliklinik_id')->references('id')->on('poliklinik');
            $table->string('tgl_periksa');
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
        Schema::dropIfExists('rekam_medis');
    }
}
