<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntriansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();
            $table->integer('no')->nullable();
            $table->integer('user_id');
            $table->integer('rekam_medis_id')->nullable();
            // 1 : Verifikasi
            // 2 : Antri
            // 3 : Tidak Hadir
            // 4 : Hadir
            // 5 : Selesai
            // 6 : Sudah Di Check Dokter
            $table->integer('status')->default(1);
            $table->date('tanggal_antrian');
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
        Schema::dropIfExists('antrians');
    }
}
