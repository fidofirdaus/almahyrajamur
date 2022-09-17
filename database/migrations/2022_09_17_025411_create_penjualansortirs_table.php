<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansortirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualansortirs', function (Blueprint $table) {
            $table->id();
            $table->string('id_pembeli', 9);
            $table->string('id_panen', 9);
            $table->date('tanggal');
            $table->float('berat_awal', 11, 1);
            $table->float('berat_terjual', 11, 1)->nullable();
            $table->integer('total_harga')->nullable();
            $table->string('status', 20)->nullable();
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
        Schema::dropIfExists('penjualansortirs');
    }
}
