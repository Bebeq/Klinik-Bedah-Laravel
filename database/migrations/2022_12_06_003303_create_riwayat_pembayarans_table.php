<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pembayarans', function (Blueprint $table) {
            // MASIH SEMENTARA
            $table->id();
            $table->string('no_pembayaran');
            $table->bigInteger('user_id');
            $table->bigInteger('created_id');
            $table->string('biaya_dokter')->nullable();
            $table->string('biaya_tindakan')->nullable();
            $table->string('biaya_lain')->nullable();
            $table->string('biaya_obat')->nullable();
            $table->string('biaya_jumlah');
            $table->string('tanggal_pembayaran');
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
        Schema::dropIfExists('riwayat_pembayarans');
    }
}
