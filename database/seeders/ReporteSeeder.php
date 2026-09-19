<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReporteSeeder extends Seeder
{
    public function run(): void
    {
        $reports = [
            ['id_reporte' => 1, 'id_usuario' => 1, 'tipo_reporte' => 'ventas', 'fecha_generacion' => '2026-09-01'],
            ['id_reporte' => 2, 'id_usuario' => 2, 'tipo_reporte' => 'inventario', 'fecha_generacion' => '2026-09-02'],
            ['id_reporte' => 3, 'id_usuario' => 3, 'tipo_reporte' => 'clientes', 'fecha_generacion' => '2026-09-03'],
            ['id_reporte' => 4, 'id_usuario' => 4, 'tipo_reporte' => 'pedidos', 'fecha_generacion' => '2026-09-04'],
            ['id_reporte' => 5, 'id_usuario' => 5, 'tipo_reporte' => 'productos', 'fecha_generacion' => '2026-09-05'],
        ];

        foreach ($reports as $report) {
            DB::table('reporte')->updateOrInsert(['id_reporte' => $report['id_reporte']], $report);
        }
    }
}