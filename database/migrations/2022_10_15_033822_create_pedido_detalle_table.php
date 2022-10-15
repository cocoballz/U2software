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
        Schema::create('pedido_detalle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pedido')->nullable(0)->comment('referencia a pedido');
            $table->foreign('id_pedido')->references('id')->on('pedido');
            $table->unsignedBigInteger('id_producto')->nullable(0)->comment('referencia a que producto');
            $table->foreign('id_producto')->references('id')->on('producto');
            $table->unsignedInteger('p__d_cantidad')->nullable(FALSE)->default(1)->comment('Cantidad de producto');
            $table->string('p_d_comentario')->nullable(0)->comment('observacion producto');
            $table->unsignedInteger('p_d_estado')->nullable(FALSE)->default(1)->comment('estado del pedido detalle');

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
        Schema::dropIfExists('pedido_detalle');
    }
};
