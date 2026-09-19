<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcaSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['id_marca' => 1, 'nombre_marca' => 'Nike', 'descripcion_marca' => 'Marca deportiva internacional'],
            ['id_marca' => 2, 'nombre_marca' => 'Adidas', 'descripcion_marca' => 'Ropa y calzado deportivo'],
            ['id_marca' => 3, 'nombre_marca' => 'New Era', 'descripcion_marca' => 'Gorras y accesorios oficiales'],
            ['id_marca' => 4, 'nombre_marca' => 'Mitchell & Ness', 'descripcion_marca' => 'Indumentaria deportiva retro'],
            ['id_marca' => 5, 'nombre_marca' => 'Raiders', 'descripcion_marca' => 'Productos oficiales del equipo'],
        ];

        foreach ($brands as $brand) {
            DB::table('marca')->updateOrInsert(['id_marca' => $brand['id_marca']], $brand);
        }
    }
}