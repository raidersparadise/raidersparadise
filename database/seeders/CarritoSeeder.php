<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarritoSeeder extends Seeder
{
    public function run(): void
    {
        $carts = [
            ['id_carrito' => 1, 'id_cliente' => 1, 'fecha_agregado' => '2026-09-11'],
            ['id_carrito' => 2, 'id_cliente' => 2, 'fecha_agregado' => '2026-09-11'],
            ['id_carrito' => 3, 'id_cliente' => 3, 'fecha_agregado' => '2026-09-12'],
            ['id_carrito' => 4, 'id_cliente' => 4, 'fecha_agregado' => '2026-09-12'],
            ['id_carrito' => 5, 'id_cliente' => 5, 'fecha_agregado' => '2026-09-13'],
        ];

        foreach ($carts as $cart) {
            DB::table('carrito')->updateOrInsert(['id_carrito' => $cart['id_carrito']], $cart);
        }
    }
}