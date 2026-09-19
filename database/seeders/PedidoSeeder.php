<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            ['id_pedido' => 1, 'fecha' => '2026-09-14 09:00:00', 'estado' => 'programado', 'total' => 90000, 'id_cliente' => 1],
            ['id_pedido' => 2, 'fecha' => '2026-09-14 10:30:00', 'estado' => 'en_curso', 'total' => 65000, 'id_cliente' => 2],
            ['id_pedido' => 3, 'fecha' => '2026-09-14 11:15:00', 'estado' => 'Entregado', 'total' => 180000, 'id_cliente' => 3],
            ['id_pedido' => 4, 'fecha' => '2026-09-15 08:45:00', 'estado' => 'programado', 'total' => 190000, 'id_cliente' => 4],
            ['id_pedido' => 5, 'fecha' => '2026-09-15 12:00:00', 'estado' => 'cancelado', 'total' => 60000, 'id_cliente' => 5],
        ];

        foreach ($orders as $order) {
            DB::table('pedido')->updateOrInsert(['id_pedido' => $order['id_pedido']], $order);
        }
    }
}