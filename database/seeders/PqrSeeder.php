<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PqrSeeder extends Seeder
{
    public function run(): void
    {
        $pqrs = [
            ['id_pqr' => 1, 'id_usuario' => 1, 'id_cliente' => 1, 'descripcion_pqr' => 'Consulta sobre el estado del pedido.', 'estado' => 'recibida', 'fecha' => '2026-09-06'],
            ['id_pqr' => 2, 'id_usuario' => 2, 'id_cliente' => 2, 'descripcion_pqr' => 'Solicitud de cambio de talla.', 'estado' => 'asignada', 'fecha' => '2026-09-07'],
            ['id_pqr' => 3, 'id_usuario' => 3, 'id_cliente' => 3, 'descripcion_pqr' => 'Pregunta sobre disponibilidad de producto.', 'estado' => 'en proceso', 'fecha' => '2026-09-08'],
            ['id_pqr' => 4, 'id_usuario' => 4, 'id_cliente' => 4, 'descripcion_pqr' => 'Reporte de inconveniente con entrega.', 'estado' => 'requerido', 'fecha' => '2026-09-09'],
            ['id_pqr' => 5, 'id_usuario' => 5, 'id_cliente' => 5, 'descripcion_pqr' => 'Confirmacion de solicitud atendida.', 'estado' => 'cerrada', 'fecha' => '2026-09-10'],
        ];

        foreach ($pqrs as $pqr) {
            DB::table('pqr')->updateOrInsert(['id_pqr' => $pqr['id_pqr']], $pqr);
        }
    }
}