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
        Schema::create('pqr', function (Blueprint $table) {
            $table->id("id_pqr");
            $table->unsignedInteger("id_usuario");
            $table->unsignedInteger("id_cliente");
            $table->string("descripcion_pqr", 255);
            $table->enum("estado", ["recibida","asignada","en proceso", "requerido","cerrada","rechazada"]);
            $table->date("fecha");

            $table->foreign("id_usuario")
                  ->references("id")
                  ->on("usuario");

            $table->foreign("id_cliente")
                  ->references("id")
                  ->on("cliente");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pqr');
    }
};