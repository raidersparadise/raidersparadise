<?php

namespace App\Services;

use App\Interfaces\InventarioInterface;
use App\Models\Inventario;

class InventarioService implements InventarioInterface
{
    public function getAll()
    {
        return Inventario::with('producto')->get();
    }

    public function getById(int $id)
    {
        return Inventario::with('producto')->findOrFail($id);
    }

    public function create(array $datos)
    {
        return Inventario::create($datos);
    }

    public function update(array $datos, int $id)
    {
        $inventario = Inventario::findOrFail($id);

        $inventario->update($datos);

        return $inventario->load('producto');
    }

    public function delete(int $id)
    {
        $inventario = Inventario::findOrFail($id);

        $inventario->delete();

        return true;
    }

    public function getByCantidadDisponible(int $cantidad_disponible)
    {
        return Inventario::with('producto')
            ->where('cantidad_disponible', $cantidad_disponible)
            ->get();
    }

    public function getByCantidadMinima(int $cantidad_minima)
    {
        return Inventario::with('producto')
            ->where('cantidad_minima', $cantidad_minima)
            ->get();
    }

    public function getByProducto(int $id_producto)
    {
        return Inventario::with('producto')
            ->where('id_producto', $id_producto)
            ->get();
    }
}