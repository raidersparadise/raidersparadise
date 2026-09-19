<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetalleCarritoSeeder extends Seeder
{
    public function run(): void
    {
        $details = [
            ['id_detalle_carrito' => 1, 'id_carrito' => 1, 'id_producto' => 1, 'cantidad' => 2, 'precio_unitario' => 45000, 'subtotal' => 90000],
            ['id_detalle_carrito' => 2, 'id_carrito' => 2, 'id_producto' => 2, 'cantidad' => 1, 'precio_unitario' => 65000, 'subtotal' => 65000],
            ['id_detalle_carrito' => 3, 'id_carrito' => 3, 'id_producto' => 3, 'cantidad' => 1, 'precio_unitario' => 180000, 'subtotal' => 180000],
            ['id_detalle_carrito' => 4, 'id_carrito' => 4, 'id_producto' => 4, 'cantidad' => 2, 'precio_unitario' => 95000, 'subtotal' => 190000],
            ['id_detalle_carrito' => 5, 'id_carrito' => 5, 'id_producto' => 5, 'cantidad' => 3, 'precio_unitario' => 20000, 'subtotal' => 60000],
        ];

        foreach ($details as $detail) {
            DB::table('detalle_carrito')->updateOrInsert(['id_detalle_carrito' => $detail['id_detalle_carrito']], $detail);
        }
    }
}