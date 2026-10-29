<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pqr', function (Blueprint $table) {
            $table->id('id_pqr');
            // Usuario (empleado) responsable de atenderla: se asigna después, por eso es opcional
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->unsignedBigInteger('id_cliente');
            $table->enum('tipo', ['peticion', 'queja', 'reclamo', 'sugerencia'])->default('peticion');
            $table->string('asunto', 120);
            $table->string('descripcion_pqr', 1000);
            $table->enum('estado', ['recibida', 'asignada', 'en proceso', 'requerido', 'cerrada', 'rechazada'])->default('recibida');
            $table->text('respuesta')->nullable();
            $table->date('fecha');
            $table->dateTime('fecha_cierre')->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->nullOnDelete();
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pqr');
    }
};
