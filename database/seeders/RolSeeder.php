<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [Rol::ADMIN, 'Acceso total: catálogo, inventario, pedidos, PQR, usuarios y reportes gerenciales.'],
            [Rol::VENDEDOR, 'Gestiona catálogo, inventario, pedidos, clientes y PQR. No accede a reportes ni usuarios.'],
            [Rol::CLIENTE, 'Compra en la tienda, consulta sus pedidos y facturas y radica PQR.'],
        ];

        foreach ($roles as [$nombre, $descripcion]) {
            Rol::updateOrCreate(['nombre_rol' => $nombre], ['descripcion' => $descripcion]);
        }
    }
}
