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
        Schema::create('detalle_pedido', function (Blueprint $table) {
            $table->id("id_detalle_pedido");
            $table->unsignedInteger("cantidad");
            $table->decimal("precio_unitario", 10,2);
            $table->decimal("sub_total", 10,2);
            $table->timestamps();

        $table->unsignedBigInteger("id_pedido");
		$table->foreign("id_pedido")->references("id_pedido")->on("pedido")->onDelete("cascade");

        $table->unsignedBigInteger("id_producto");
		$table->foreign("id_producto")->references("id_producto")->on("producto")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedido');
    }
};
