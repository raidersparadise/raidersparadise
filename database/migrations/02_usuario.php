<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id("id_usuario");
            $table->unsignedBigInteger("id_rol");
            $table->string("nombre_usuario", 40);
            $table->string("apellido_usuario", 40);
            $table->string("email", 100)->unique();
            $table->string("password", 60);

            $table->foreign("id_rol")
                  ->references("id")
                  ->on("rol");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};