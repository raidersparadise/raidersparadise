<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['id_usuario' => 1, 'id_rol' => 1, 'nombre_usuario' => 'Ana', 'apellido_usuario' => 'Gomez', 'email' => 'ana.gomez@raiders.test'],
            ['id_usuario' => 2, 'id_rol' => 2, 'nombre_usuario' => 'Carlos', 'apellido_usuario' => 'Mendez', 'email' => 'carlos.mendez@raiders.test'],
            ['id_usuario' => 3, 'id_rol' => 3, 'nombre_usuario' => 'Laura', 'apellido_usuario' => 'Rojas', 'email' => 'laura.rojas@raiders.test'],
            ['id_usuario' => 4, 'id_rol' => 4, 'nombre_usuario' => 'Diego', 'apellido_usuario' => 'Torres', 'email' => 'diego.torres@raiders.test'],
            ['id_usuario' => 5, 'id_rol' => 5, 'nombre_usuario' => 'Sofia', 'apellido_usuario' => 'Vargas', 'email' => 'sofia.vargas@raiders.test'],
        ];

        foreach ($users as $user) {
            DB::table('usuario')->updateOrInsert(
                ['id_usuario' => $user['id_usuario']],
                [...$user, 'password' => Hash::make('secret123')]
            );
        }
    }
}