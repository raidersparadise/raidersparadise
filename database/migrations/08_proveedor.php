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

            $table->string('nombre_proveedor', 40);
            $table->string('telefono_proveedor', 20);
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