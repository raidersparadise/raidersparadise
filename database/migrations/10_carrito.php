<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id('id_carrito');
            $table->unsignedBigInteger('id_cliente')->unique(); // un carrito activo por cliente
            $table->date('fecha_agregado');
            $table->timestamps();

            $table->foreign('id_cliente')->references('id_cliente')->on('cliente')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito');
    }
};
