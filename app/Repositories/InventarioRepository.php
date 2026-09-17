<?php

namespace App\Repositories;

use App\Interfaces\InventarioInterface;
use App\Models\Inventario;

class InventarioRepository extends BaseRepository implements InventarioInterface
{
    public function __construct(Inventario $inventario)
    {
        parent::__construct($inventario);
    }

    public function getAll()
    {
        return $this->model
            ->with('producto')
            ->get();
    }

    public function getById(int $id)
    {
        return $this->model
            ->with('producto')
            ->find($id);
    }

    public function create(array $datos)
    {
        return $this->model
            ->create($datos)
            ->load('producto');
    }

    public function update(array $datos, int $id)
    {
        $inventario = $this->model->find($id);

        if (!$inventario) {
            return null;
        }

        $inventario->update($datos);

        return $inventario
            ->fresh()
            ->load('producto');
    }

    public function getByCantidadDisponible(int $cantidad_disponible)
    {
        return $this->model
            ->with('producto')
            ->where(
                'cantidad_disponible',
                $cantidad_disponible
            )
            ->get();
    }

    public function getByCantidadMinima(int $cantidad_minima)
    {
        return $this->model
            ->with('producto')
            ->where(
                'cantidad_minima',
                $cantidad_minima
            )
            ->get();
    }

    public function getByProducto(int $id_producto)
    {
        return $this->model
            ->with('producto')
            ->where(
                'id_producto',
                $id_producto
            )
            ->get();
    }
}