<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['id_categoria' => 1, 'nombre_categoria' => 'Camisetas', 'descripcion_categoria' => 'Camisetas oficiales y casuales'],
            ['id_categoria' => 2, 'nombre_categoria' => 'Gorras', 'descripcion_categoria' => 'Gorras y accesorios para la cabeza'],
            ['id_categoria' => 3, 'nombre_categoria' => 'Chaquetas', 'descripcion_categoria' => 'Chaquetas deportivas y urbanas'],
            ['id_categoria' => 4, 'nombre_categoria' => 'Pantalones', 'descripcion_categoria' => 'Pantalones y joggers deportivos'],
            ['id_categoria' => 5, 'nombre_categoria' => 'Accesorios', 'descripcion_categoria' => 'Accesorios oficiales del equipo'],
        ];

        foreach ($categories as $category) {
            DB::table('categoria')->updateOrInsert(['id_categoria' => $category['id_categoria']], $category);
        }
    }
}