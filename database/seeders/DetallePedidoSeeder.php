<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetallePedidoSeeder extends Seeder
{
    public function run(): void
    {
        $details = [
            ['id_detalle_pedido' => 1, 'cantidad' => 2, 'precio_unitario' => 45000, 'sub_total' => 90000, 'id_pedido' => 1, 'id_producto' => 1],
            ['id_detalle_pedido' => 2, 'cantidad' => 1, 'precio_unitario' => 65000, 'sub_total' => 65000, 'id_pedido' => 2, 'id_producto' => 2],
            ['id_detalle_pedido' => 3, 'cantidad' => 1, 'precio_unitario' => 180000, 'sub_total' => 180000, 'id_pedido' => 3, 'id_producto' => 3],
            ['id_detalle_pedido' => 4, 'cantidad' => 2, 'precio_unitario' => 95000, 'sub_total' => 190000, 'id_pedido' => 4, 'id_producto' => 4],
            ['id_detalle_pedido' => 5, 'cantidad' => 3, 'precio_unitario' => 20000, 'sub_total' => 60000, 'id_pedido' => 5, 'id_producto' => 5],
        ];

        foreach ($details as $detail) {
            DB::table('detalle_pedido')->updateOrInsert(['id_detalle_pedido' => $detail['id_detalle_pedido']], $detail);
        }
    }
}