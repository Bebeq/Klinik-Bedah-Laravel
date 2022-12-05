<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsPembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_pembayarans', function (Blueprint $table) {
            // MASIH SEMENTARA
            $table->id();
            $table->bigInteger('riwayat_pembayaran_id');
            $table->bigInteger('antrian_id');
            $table->varchar('keterangan');
            $table->varchar('bayar');
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
        Schema::dropIfExists('details_pembayarans');
    }
}
