<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_carrito', function (Blueprint $table) {
            $table->id("id_detalle_carrito");
            $table->unsignedBigInteger("id_carrito");
            $table->foreign("id_carrito")->references("id_carrito")->on("carrito")->onDelete("cascade");
            $table->unsignedBigInteger("id_producto");
            $table->foreign("id_producto")->references("id_producto")->on("producto")->onDelete("cascade");
            $table->unsignedInteger("cantidad");
            $table->decimal("precio_unitario", 12, 2);
            $table->decimal("subtotal", 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_carrito');
    }
};
