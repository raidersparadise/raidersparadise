<?php

namespace App\Services;

use App\Interfaces\InventarioInterface;

class InventarioService
{
    protected InventarioInterface $inventarioRepository;

    public function __construct(InventarioInterface $inventarioRepository)
    {
        $this->inventarioRepository = $inventarioRepository;
    }

    public function getAll()
    {
        return $this->inventarioRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->inventarioRepository->getById($id);
    }

    public function create(array $data)
    {
        return $this->inventarioRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->inventarioRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->inventarioRepository->delete($id);
    }

    public function getByCantidadDisponible(int $cantidad_disponible)
    {
        return $this->inventarioRepository->getByCantidadDisponible($cantidad_disponible);
    }

    public function getByCantidadMinima(int $cantidad_minima)
    {
        return $this->inventarioRepository->getByCantidadMinima($cantidad_minima);
    }

    public function getByProducto(int $id_producto)
    {
        return $this->inventarioRepository->getByProducto($id_producto);
    }
}