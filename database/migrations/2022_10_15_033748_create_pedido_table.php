<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente')->nullable(0)->comment('referencia a cliente');
            $table->foreign('id_cliente')->references('id')->on('cliente');
            $table->string('pe_tramite')->nullable(0)->comment('estado del pedido /en espera/despachado/');
            $table->unsignedInteger('pe_estado')->nullable(FALSE)->default(1)->comment('estado del pedido');
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
        Schema::dropIfExists('pedido');
    }
};
