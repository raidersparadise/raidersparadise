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
        Schema::create('factura', function (Blueprint $table) {
            $table->id();
            $table->datetime("fecha_factura");
            $table->decimal("total_factura", 10,2);
            $table->decimal("impuesto", 10,2);
            $table->string("estado_factura", 50);
            $table->decimal("pago", 10,2); 
            $table->string("metodo_pago", 50);
            $table->timestamps();

        $table->unsignedBigInteger("id_pedido");
		$table->foreign("id_pedido")->references("id_pedido")->on("pedido")->onDelete("cascade");

        });
    }
  
    /**
     * Reverse the migraciones hptas.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura');
    }
};
