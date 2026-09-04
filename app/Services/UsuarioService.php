<?php

namespace App\Services;

use App\Interfaces\UsuarioInterface;
use App\Models\Usuario;

class UsuarioService implements UsuarioInterface
{
    // Obtener todos los usuarios
    public function getAll()
    {
        return Usuario::with('rol')->get();
    }

    // Obtener usuario por ID
    public function getById(int $id)
    {
        return Usuario::with('rol')->findOrFail($id);
    }

    // Crear un usuario
    public function create(array $datos)
    {
        return Usuario::create($datos);
    }

    // Actualizar un usuario
    public function update(array $datos, int $id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->update($datos);

        return $usuario->load('rol');
    }

    // Eliminar un usuario
    public function delete(int $id)
    {
        $usuario = Usuario::findOrFail($id);

        return $usuario->delete();
    }

    // Buscar usuarios por nombre
    public function getByName(string $nombre)
    {
        return Usuario::with('rol')
            ->where(
                'nombre_usuario',
                'LIKE',
                '%' . $nombre . '%'
            )
            ->get();
    }

    // Buscar usuario por correo
    public function getByEmail(string $email)
    {
        return Usuario::with('rol')
            ->where('email', $email)
            ->first();
    }

    // Buscar usuarios por rol
    public function getByRol(int $id_rol)
    {
        return Usuario::with('rol')
            ->where('id_rol', $id_rol)
            ->get();
    }
}