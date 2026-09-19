<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventarioSeeder extends Seeder
{
    public function run(): void
    {
        $inventory = [
            ['id_inventario' => 1, 'cantidad_disponible' => 25, 'cantidad_minima' => 5, 'id_producto' => 1],
            ['id_inventario' => 2, 'cantidad_disponible' => 18, 'cantidad_minima' => 4, 'id_producto' => 2],
            ['id_inventario' => 3, 'cantidad_disponible' => 10, 'cantidad_minima' => 2, 'id_producto' => 3],
            ['id_inventario' => 4, 'cantidad_disponible' => 30, 'cantidad_minima' => 6, 'id_producto' => 4],
            ['id_inventario' => 5, 'cantidad_disponible' => 40, 'cantidad_minima' => 8, 'id_producto' => 5],
        ];

        foreach ($inventory as $item) {
            DB::table('inventario')->updateOrInsert(['id_inventario' => $item['id_inventario']], $item);
        }
    }
}