<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('id_pembelian')->unique();
            $table->unsignedBigInteger('id_supplier');
            $table->foreign('id_supplier')->references('id')->on('suppliers');
            $table->integer('total_transaksi');
            $table->unsignedBigInteger('id_admin');
            $table->foreign('id_admin')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembelians');
    }
};
