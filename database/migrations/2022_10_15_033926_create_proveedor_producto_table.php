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
        Schema::create('proveedor_producto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proveedor')->nullable(0)->comment('referencia a proveedor');
            $table->foreign('id_proveedor')->references('id')->on('proveedor');
            $table->unsignedBigInteger('id_producto')->nullable(0)->comment('referencia a proveedor');
            $table->foreign('id_producto')->references('id')->on('producto');
            $table->unsignedInteger('pv_p_estado')->nullable(FALSE)->default(1)->comment('estado producto del proveedor');
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
        Schema::dropIfExists('proveedor_producto');
    }
};
