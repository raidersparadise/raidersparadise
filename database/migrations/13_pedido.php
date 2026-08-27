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
        Schema::create('pedido', function (Blueprint $table) {
            $table->id("id_pedido");
            $table->datetime("fecha");
            $table->enum("estado", ["programado","en_curso","Entregado","cancelado"]);
            $table->decimal("total", 10,2);
            $table->timestamps();

        $table->unsignedBigInteger("id_cliente");
		$table->foreign("id_cliente")->references("id_cliente")->on("cliente")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido');
    }
};
