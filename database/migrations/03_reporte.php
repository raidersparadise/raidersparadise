<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reporte', function (Blueprint $table) {
            $table->id('id_reporte');
            $table->unsignedBigInteger('id_usuario');
            $table->string('tipo_reporte', 100);
            $table->string('formato', 20)->default('pantalla');
            $table->date('fecha_desde')->nullable();
            $table->date('fecha_hasta')->nullable();
            $table->dateTime('fecha_generacion');
            $table->timestamps();

            $table->foreign('id_usuario')->references('id_usuario')->on('usuario')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reporte');
    }
};
