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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_categoria_producto');
            $table->string('nombre');
            $table->string('clave');
            $table->float('precio_venta',8,2);
            $table->float('precio2',8,2)->nullable();
            $table->float('precio3',8,2)->nullable();
            $table->float('iva',8,2);
            $table->integer('id_empresa');
            $table->integer('tipo');
            $table->integer('id_unidad_producto');
            $table->integer('estatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
