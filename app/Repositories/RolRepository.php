<?php

namespace App\Repositories;

use App\Interfaces\RolInterface;
use App\Models\Rol;

class RolRepository extends BaseRepository implements RolInterface
{
    public function __construct(Rol $rol)
    {
        parent::__construct($rol);
    }

    public function getAll()
    {
        return $this->model
            ->with('usuarios')
            ->get();
    }

    public function getById(int $id)
    {
        return $this->model
            ->with('usuarios')
            ->find($id);
    }

    public function create(array $datos)
    {
        return $this->model
            ->create($datos)
            ->load('usuarios');
    }

    public function update(array $datos, int $id)
    {
        $rol = $this->model->find($id);

        if (!$rol) {
            return null;
        }

        $rol->update($datos);

        return $rol
            ->fresh()
            ->load('usuarios');
    }

    public function getByNombreRol(string $nombre_rol)
    {
        return $this->model
            ->with('usuarios')
            ->where(
                'nombre_rol',
                'LIKE',
                '%' . $nombre_rol . '%'
            )
            ->get();
    }

    public function getByDescripcion(string $descripcion)
    {
        return $this->model
            ->with('usuarios')
            ->where(
                'descripcion',
                'LIKE',
                '%' . $descripcion . '%'
            )
            ->get();
    }
}