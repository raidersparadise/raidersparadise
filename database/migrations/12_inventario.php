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
        Schema::create('inventario', function (Blueprint $table) {
            $table->id("id_inventario");
            $table->unsignedInteger("cantidad_disponible");
		    $table->unsignedInteger("cantidad_minima");
            $table->timestamps();

		$table->unsignedBigInteger("id_producto");
		$table->foreign("id_producto")->references("id_producto")->on("producto")->onDelete("cascade");
;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario');
    }
};
