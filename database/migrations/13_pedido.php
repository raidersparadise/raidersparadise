<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->id('id_pedido');
            $table->unsignedBigInteger('id_cliente');
            $table->dateTime('fecha');
            // corregido: se unificó en minúsculas (antes mezclaba "Entregado" con "en_curso")
            $table->enum('estado', ['pendiente', 'programado', 'en_curso', 'entregado', 'cancelado'])->default('pendiente');
            $table->decimal('total', 12, 2);
            $table->string('direccion_envio', 150)->nullable();
            $table->string('ciudad_envio', 60)->nullable();
            $table->string('notas', 255)->nullable();
            $table->timestamps();

            $table->index('fecha');
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedido');
    }
};
