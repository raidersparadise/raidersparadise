<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('id_cliente');
            // Enlace con la cuenta de acceso (un cliente puede comprar con su usuario)
            $table->unsignedBigInteger('id_usuario')->nullable()->unique();
            $table->string('documento', 20)->nullable();
            $table->string('nombre_cliente', 40);
            $table->string('apellido_cliente', 40);
            $table->string('email', 150)->unique();
            $table->string('telefono', 20)->nullable();   // corregido: decía ->nullabel()
            $table->string('direccion', 100)->nullable(); // corregido: decía ->nullabel()
            $table->string('ciudad', 60)->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
