<?php

namespace App\Services;

use App\Interfaces\RolInterface;
use App\Models\Rol;

class RolService implements RolInterface
{
    public function getAll()
    {
        return Rol::all();
    }

    public function getById(int $id)
    {
        return Rol::findOrFail($id);
    }

    public function create(array $data)
    {
        return Rol::create($data);
    }

    public function update(array $datos, int $id)
    {
        $rol = Rol::findOrFail($id);

        $rol->update($datos);

        return $rol;
    }

    public function delete(int $id)
    {
        $rol = Rol::findOrFail($id);

        return $rol->delete();
    }

    public function getByNombreRol(string $nombre_rol)
    {
        return Rol::where(
            'nombre_rol',
            'like',
            '%' . $nombre_rol . '%'
        )->get();
    }

    public function getByDescripcion(string $descripcion)
    {
        return Rol::where(
            'descripcion',
            'like',
            '%' . $descripcion . '%'
        )->get();
    }
}