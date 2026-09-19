<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('proveedor', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('producto', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('proveedor', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('producto', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};