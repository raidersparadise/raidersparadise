<?php

namespace App\Repositories;

use App\Models\DetalleCarrito;

class DetalleCarritoRepository
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
        $detalleCarrito = DetalleCarrito::findOrFail($id);

        $detalleCarrito->update($datos);

        return $detalleCarrito;
    }

    // Eliminar detalle del carrito
    public function delete(int $id)
    {
        $detalleCarrito = DetalleCarrito::findOrFail($id);

        return $detalleCarrito->delete();
    }

    // Buscar detalles por carrito
    public function getByCarrito(int $id_carrito)
    {
        return DetalleCarrito::where('id_carrito', $id_carrito)->get();
    }

    // Buscar detalles por producto
    public function getByProducto(int $id_producto)
    {
        return DetalleCarrito::where('id_producto', $id_producto)->get();
    }

    // Obtener detalles con carrito y producto
    public function getAllWithRelations()
    {
        return DetalleCarrito::with(['carrito', 'producto'])->get();
    }
}