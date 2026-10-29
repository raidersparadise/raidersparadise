<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->id('id_inventario');
            $table->unsignedBigInteger('id_producto')->unique(); // un registro de stock por producto
            $table->unsignedInteger('cantidad_disponible')->default(0);
            $table->unsignedInteger('cantidad_minima')->default(3);
            $table->timestamps();

            $table->foreign('id_producto')->references('id_producto')->on('producto')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventario');
    }
};
