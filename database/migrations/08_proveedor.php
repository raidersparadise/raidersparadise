<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->id('id_proveedor');
            $table->string('nit', 20)->nullable();
            $table->string('nombre_proveedor', 80);
            // corregido: era integer; un celular de 10 dígitos (3001234567) desborda un INT
            $table->string('telefono_proveedor', 20)->nullable();
            $table->string('direccion_proveedor', 100)->nullable();
            $table->string('email_proveedor', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proveedor');
    }
};
