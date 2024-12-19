<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendaKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->string('tpk');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('pola_kegiatan');
            $table->string('flyer')->nullable();
            $table->string('materi')->nullable();
            $table->string('dokumentasi')->nullable();
            $table->string('panduan')->nullable();
            $table->string('jenis_kegiatan');
            $table->string('kode_kegiatan')->unique();
            $table->string('status');
            $table->unsignedBigInteger('id_user');
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
        Schema::dropIfExists('agenda_kegiatans');
    }
}
