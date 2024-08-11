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
        Schema::create('provedors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_provedor');
            $table->string('direccion');
            $table->string('correo');
            $table->integer('id_categoria');
            $table->integer('id_empresa');
            $table->string('nombre_empresa');
            $table->string('razon_social');
            $table->string('telefono');
            $table->integer('id_Estatus_provedor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provedors');
    }
};
