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
        Schema::create('proveedor_pedido', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proveedor_pedido')->nullable(0)->comment('referencia a proveedor y producto');
            $table->foreign('id_proveedor_pedido')->references('id')->on('proveedor_producto');
            $table->unsignedBigInteger('pv_pe_cantidad')->nullable(0)->comment('Cantidad solicitada a proveedor');
            $table->unsignedInteger('pv_pe_estado')->nullable(FALSE)->default(1)->comment('estado producto del proveedor');
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
        Schema::dropIfExists('proveedor_pedido');
    }
};
