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
        Schema::create('c_p_s', function (Blueprint $table) {
            $table->id();
            $table->string("codigo");
            $table->string("descripcion");
            $table->string("pais");
            $table->string("estado");
            $table->string("municipio");
            $table->string("ciudad");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_p_s');
    }
};
