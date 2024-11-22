<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSertifikatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_sertifikats', function (Blueprint $table) {
            $table->id();
            $table->integer('id_biodata');
            $table->string('nomor_sertifikat');
            $table->date('tanggal_ttd');
            $table->integer('id_penanggungjawab');
            $table->string('id_kepala');
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
        Schema::dropIfExists('data_sertifikats');
    }
}
