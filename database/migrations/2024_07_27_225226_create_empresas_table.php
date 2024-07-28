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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string("ciudad");
            $table->integer("codigo_postal");
            $table->string("domicilio_fiscal");
            $table->string("giro");
            $table->string("nombre_empresa");;
            $table->string("razon_social");
            $table->string("RFC");
            $table->string("pais");
            $table->integer("estatus_empresa");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
