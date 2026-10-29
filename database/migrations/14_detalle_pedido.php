<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_pedido', function (Blueprint $table) {
            $table->id('id_detalle_pedido');
            $table->unsignedBigInteger('id_pedido');
            $table->unsignedBigInteger('id_producto');
            $table->unsignedInteger('cantidad');
            $table->decimal('precio_unitario', 12, 2);
            $table->decimal('sub_total', 12, 2);
            $table->timestamps();

            $table->foreign('id_pedido')->references('id_pedido')->on('pedido')->cascadeOnDelete();
            // corregido: antes era cascade; borrar un producto eliminaba el historial de ventas
            $table->foreign('id_producto')->references('id_producto')->on('producto')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_pedido');
    }
};
