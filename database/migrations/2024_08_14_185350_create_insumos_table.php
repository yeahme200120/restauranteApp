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
        Schema::create('insumos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->integer('id_area_almacen');
            $table->float('precio_unitario',8,2);
            $table->float('iva',8,2);
            $table->integer('id_unidad');
            $table->float('cantidad',8,2);
            $table->integer('id_empresa');
            $table->integer('id_provedor');
            $table->integer('estatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insumos');
    }
};
