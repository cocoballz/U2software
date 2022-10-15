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
        Schema::create('proveedor', function (Blueprint $table) {
            $table->id();
            $table->string('pv_nombre')->nullable(FALSE)->comment('Nombre proveedor');
            $table->string('pv_mail')->nullable(FALSE)->comment('Correo proveedor');
            $table->unsignedInteger('pv_contacto')->nullable(FALSE)->default(1)->comment('contacto proveedor');
            $table->unsignedInteger('pv_estado')->nullable(FALSE)->default(1)->comment('estado proveedor');
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
        Schema::dropIfExists('proveedor');
    }
};
