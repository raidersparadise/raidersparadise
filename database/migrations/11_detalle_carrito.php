<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_carrito', function (Blueprint $table) {
            $table->id('id_detalle_carrito');
            $table->unsignedBigInteger('id_carrito');
            $table->unsignedBigInteger('id_producto');
            $table->unsignedInteger('cantidad');
            $table->decimal('precio_unitario', 12, 2);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();

            $table->unique(['id_carrito', 'id_producto']);
            $table->foreign('id_carrito')->references('id_carrito')->on('carrito')->cascadeOnDelete();
            $table->foreign('id_producto')->references('id_producto')->on('producto')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_carrito');
    }
};
