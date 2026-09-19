<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacturaSeeder extends Seeder
{
    public function run(): void
    {
        $invoices = [
            ['id' => 1, 'fecha_factura' => '2026-09-14 09:30:00', 'total_factura' => 90000, 'impuesto' => 0, 'estado_factura' => 'pagada', 'pago' => 90000, 'metodo_pago' => 'tarjeta', 'id_pedido' => 1],
            ['id' => 2, 'fecha_factura' => '2026-09-14 11:00:00', 'total_factura' => 65000, 'impuesto' => 0, 'estado_factura' => 'pagada', 'pago' => 65000, 'metodo_pago' => 'transferencia', 'id_pedido' => 2],
            ['id' => 3, 'fecha_factura' => '2026-09-14 12:00:00', 'total_factura' => 180000, 'impuesto' => 0, 'estado_factura' => 'pagada', 'pago' => 180000, 'metodo_pago' => 'tarjeta', 'id_pedido' => 3],
            ['id' => 4, 'fecha_factura' => '2026-09-15 09:00:00', 'total_factura' => 190000, 'impuesto' => 0, 'estado_factura' => 'pendiente', 'pago' => 0, 'metodo_pago' => 'contraentrega', 'id_pedido' => 4],
            ['id' => 5, 'fecha_factura' => '2026-09-15 12:15:00', 'total_factura' => 60000, 'impuesto' => 0, 'estado_factura' => 'anulada', 'pago' => 0, 'metodo_pago' => 'tarjeta', 'id_pedido' => 5],
        ];

        foreach ($invoices as $invoice) {
            DB::table('factura')->updateOrInsert(['id' => $invoice['id']], $invoice);
        }
    }
}