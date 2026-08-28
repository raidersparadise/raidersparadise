<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pqr', function (Blueprint $table) {
            $table->id("id_pqr");

            $table->unsignedBigInteger("id_usuario");
            $table->unsignedBigInteger("id_cliente");

            $table->string("descripcion_pqr", 255);

            $table->enum("estado", [
                "recibida",
                "asignada",
                "en proceso",
                "requerido",
                "cerrada",
                "rechazada"
            ]);

            $table->date("fecha");

            $table->foreign("id_usuario")
                  ->references("id_usuario")
                  ->on("usuario");

            $table->foreign("id_cliente")
                  ->references("id_cliente")
                  ->on("cliente");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pqr');
    }
};
