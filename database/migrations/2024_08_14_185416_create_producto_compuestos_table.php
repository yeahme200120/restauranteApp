<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('producto_compuestos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_producto');
            $table->integer('id_insumo');
            $table->float('cantidad_insumo',8,2);
            $table->integer('id_usuario');
            $table->dateTime('fecha_uso');
            $table->integer('estatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_compuestos');
    }
};
