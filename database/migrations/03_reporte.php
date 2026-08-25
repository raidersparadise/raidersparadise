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
        Schema::create('reporte', function (Blueprint $table) {
            $table->increments("id_reporte");
            $table->unsignedInteger("id_usuario");
            $table->string("tipo_reporte", 100);
            $table->date("fecha_generacion");

            $table->foreign("id_usuario")
                  ->references("id")
                  ->on("usuario");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte');
    }
};