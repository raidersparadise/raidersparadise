<?php

namespace App\Services;

use App\Interfaces\Detalle_carritoInterface;
use App\Models\Detalle_carrito;

class DetalleCarritoService implements Detalle_carritoInterface
{
    // Obtener todos los detalles del carrito
    public function getAll()
    {
        return DetalleCarrito::all();
    }

    // Obtener detalle por ID
    public function getById(int $id)
    {
        return DetalleCarrito::findOrFail($id);
    }

    // Crear detalle del carrito
    public function create(array $datos)
    {
        return DetalleCarrito::create($datos);
    }

    // Actualizar detalle del carrito
    public function update(array $datos, int $id)
    {
        $detalle = DetalleCarrito::findOrFail($id);

        $detalle->update($datos);

        return $detalle;
    }

    // Eliminar detalle del carrito
    public function delete(int $id)
    {
        $detalle = DetalleCarrito::findOrFail($id);

        return $detalle->delete();
    }

    // Buscar detalles por carrito
    public function getByCarrito(int $id_carrito)
    {
        return DetalleCarrito::where(
            'id_carrito',
            $id_carrito
        )->get();
    }

    // Buscar detalles por producto
    public function getByProducto(int $id_producto)
    {
        return DetalleCarrito::where(
            'id_producto',
            $id_producto
        )->get();
    }
}

