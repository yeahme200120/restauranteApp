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
        Schema::create('almacens', function (Blueprint $table) {
            $table->id();
            $table->string("nombre_producto");
            $table->float("precio_compra",8,2);
            $table->float("precio_venta",8,2);
            $table->integer("id_provedor");
            $table->float("stock",8,2);
            $table->integer("id_empresa");
            $table->integer("categoria");
            $table->integer("unidad");
            $table->integer("id_estatus_producto");
            $table->integer("id_estado");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almacens');
    }
};
