<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['id_rol' => 1, 'nombre_rol' => 'Administrador', 'descripcion' => 'Acceso total al sistema'],
            ['id_rol' => 2, 'nombre_rol' => 'Vendedor', 'descripcion' => 'Gestion de ventas y pedidos'],
            ['id_rol' => 3, 'nombre_rol' => 'Soporte', 'descripcion' => 'Atencion de solicitudes de clientes'],
            ['id_rol' => 4, 'nombre_rol' => 'Bodega', 'descripcion' => 'Gestion de inventario'],
            ['id_rol' => 5, 'nombre_rol' => 'Supervisor', 'descripcion' => 'Supervision de operaciones'],
        ];

        foreach ($roles as $role) {
            DB::table('rol')->updateOrInsert(['id_rol' => $role['id_rol']], $role);
        }
    }
}