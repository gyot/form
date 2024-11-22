<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDataTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('form_datas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->bigInteger('nip')->unique();
            $table->string('email')->unique();
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nama_instansi');
            $table->string('jabatan');
            $table->string('pangkat_golongan');
            $table->string('pendidikan_terakhir');
            $table->string('no_hp');
            $table->string('provider');
            $table->string('agama');
            $table->string('kabupaten_kota');
            $table->string('nomor_rekening')->unique();
            $table->string('nama_bank');
            $table->string('tanda_tangan_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_datas');
    }
}
