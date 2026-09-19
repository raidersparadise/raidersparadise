<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            ['id_cliente' => 1, 'nombre_cliente' => 'Maria', 'apellido_cliente' => 'Lopez', 'email_cliente' => 'maria.lopez@raiders.test', 'telefono_cliente' => '3001000001', 'direccion_cliente' => 'Cra 1 #23-45'],
            ['id_cliente' => 2, 'nombre_cliente' => 'Juan', 'apellido_cliente' => 'Perez', 'email_cliente' => 'juan.perez@raiders.test', 'telefono_cliente' => '3001000002', 'direccion_cliente' => 'Calle 10 #12-30'],
            ['id_cliente' => 3, 'nombre_cliente' => 'Valentina', 'apellido_cliente' => 'Castro', 'email_cliente' => 'valentina.castro@raiders.test', 'telefono_cliente' => '3001000003', 'direccion_cliente' => 'Carrera 7 #80-12'],
            ['id_cliente' => 4, 'nombre_cliente' => 'Andres', 'apellido_cliente' => 'Mora', 'email_cliente' => 'andres.mora@raiders.test', 'telefono_cliente' => '3001000004', 'direccion_cliente' => 'Calle 45 #8-20'],
            ['id_cliente' => 5, 'nombre_cliente' => 'Camila', 'apellido_cliente' => 'Ruiz', 'email_cliente' => 'camila.ruiz@raiders.test', 'telefono_cliente' => '3001000005', 'direccion_cliente' => 'Cra 15 #60-18'],
        ];

        foreach ($clients as $client) {
            DB::table('cliente')->updateOrInsert(['id_cliente' => $client['id_cliente']], $client);
        }
    }
}