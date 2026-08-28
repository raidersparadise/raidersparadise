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
        Schema::create('producto', function (Blueprint $table) {
            $table->id('id_producto');

            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_marca');
            $table->unsignedBigInteger('id_proveedor');

            $table->string('nombre_producto', 40);
            $table->string('descripcion_producto', 255)->nullable();
            $table->decimal('precio_producto', 10, 2);
            $table->string('estado_producto', 50);
            $table->string('imagen_producto', 255)->nullable();
            $table->string('comentario_producto', 255)->nullable();

            $table->foreign('id_categoria')
                  ->references('id_categoria')
                  ->on('categoria');

            $table->foreign('id_marca')
                  ->references('id_marca')
                  ->on('marca');

            $table->foreign('id_proveedor')
                  ->references('id_proveedor')
                  ->on('proveedor');
                  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};