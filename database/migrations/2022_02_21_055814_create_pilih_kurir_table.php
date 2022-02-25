<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePilihKurirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilih_kurir', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_kurir');
            $table->unsignedBigInteger('id_penjual');
            $table->string('status');
            $table->timestamps();
            $table->foreign('id_kurir')
            ->references('id')
            ->on('kurir')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('id_penjual')
            ->references('id')
            ->on('pengguna')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pilih_kurir');
    }
}
