<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            ['id_proveedor' => 1, 'nombre_proveedor' => 'Distribuidora Central', 'telefono_proveedor' => '3002000001', 'direccion_proveedor' => 'Cra 99 #10-20', 'email_proveedor' => 'central@raiders.test'],
            ['id_proveedor' => 2, 'nombre_proveedor' => 'Textiles del Norte', 'telefono_proveedor' => '3002000002', 'direccion_proveedor' => 'Calle 20 #30-40', 'email_proveedor' => 'textiles@raiders.test'],
            ['id_proveedor' => 3, 'nombre_proveedor' => 'Accesorios Urbanos', 'telefono_proveedor' => '3002000003', 'direccion_proveedor' => 'Cra 12 #45-10', 'email_proveedor' => 'urbanos@raiders.test'],
            ['id_proveedor' => 4, 'nombre_proveedor' => 'Importaciones Oeste', 'telefono_proveedor' => '3002000004', 'direccion_proveedor' => 'Calle 70 #15-25', 'email_proveedor' => 'oeste@raiders.test'],
            ['id_proveedor' => 5, 'nombre_proveedor' => 'Logistica Deportiva', 'telefono_proveedor' => '3002000005', 'direccion_proveedor' => 'Cra 50 #8-16', 'email_proveedor' => 'logistica@raiders.test'],
        ];

        foreach ($suppliers as $supplier) {
            DB::table('proveedor')->updateOrInsert(['id_proveedor' => $supplier['id_proveedor']], $supplier);
        }
    }
}