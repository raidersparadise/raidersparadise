<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->unsignedBigInteger('id_rol');
            $table->string('nombre_usuario', 40);
            $table->string('apellido_usuario', 40);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->string('telefono', 20)->nullable();
            $table->boolean('activo')->default(true);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_rol')->references('id_rol')->on('rol');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
