<?php

namespace App\Services;

use App\Interfaces\RolInterface;

class RolService implements RolInterface
{
    public function __construct(
        private RolInterface $rolRepository
    ) {}

    public function getAll()
    {
        return $this->rolRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->rolRepository->getById($id);
    }

    public function create(array $datos)
    {
        return $this->rolRepository->create($datos);
    }

    public function update(array $datos, int $id)
    {
        return $this->rolRepository->update($datos, $id);
    }

    public function delete(int $id)
    {
        return $this->rolRepository->delete($id);
    }

    public function getByNombreRol(string $nombre_rol)
    {
        return $this->rolRepository
            ->getByNombreRol($nombre_rol);
    }

    public function getByDescripcion(string $descripcion)
    {
        return $this->rolRepository
            ->getByDescripcion($descripcion);
    }
}