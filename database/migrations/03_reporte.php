<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reporte', function (Blueprint $table) {
            $table->increments('id_reporte');

            $table->unsignedBigInteger('id_usuario');

            $table->string('tipo_reporte', 100);
            $table->date('fecha_generacion');

            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuario');

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reporte');
    }
};