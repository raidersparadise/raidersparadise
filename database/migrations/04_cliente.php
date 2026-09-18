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
        $table->string('nombre_cliente');
        $table->string('apellido_cliente');
        $table->string('email_cliente');
        $table->string('telefono_cliente');
        $table->string('direccion_cliente');
        $table->softDeletes();
        
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};