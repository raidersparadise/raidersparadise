<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('factura', function (Blueprint $table) {
            $table->id('id_factura');
            $table->unsignedBigInteger('id_pedido')->unique();
            $table->string('numero_factura', 20)->unique();
            $table->dateTime('fecha_factura');
            $table->decimal('subtotal', 12, 2);
            $table->decimal('impuesto', 12, 2);
            $table->decimal('total_factura', 12, 2);
            $table->string('estado_factura', 20); // pagada | pendiente | anulada
            $table->decimal('pago', 12, 2);
            $table->string('metodo_pago', 50);
            $table->timestamps();

            $table->foreign('id_pedido')->references('id_pedido')->on('pedido')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factura');
    }
};
