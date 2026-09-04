<?php

namespace App\Services;

use App\Interfaces\CarritoInterface;
use App\Models\Carrito;

class CarritoService implements CarritoInterface
{
    // Obtener todos los carritos
    public function getAll()
    {
        return Carrito::all();
    }

    // Obtener carrito por ID
    public function getById(int $id)
    {
        return Carrito::findOrFail($id);
    }

    // Crear carrito
    public function create(array $datos)
    {
        return Carrito::create($datos);
    }

    // Actualizar carrito
    public function update(array $datos, int $id)
    {
        $carrito = Carrito::findOrFail($id);

        $carrito->update($datos);

        return $carrito;
    }

    // Eliminar carrito
    public function delete(int $id)
    {
        $carrito = Carrito::findOrFail($id);

        return $carrito->delete();
    }

    // Buscar carritos por cliente
    public function getByCliente(int $id_cliente)
    {
        return Carrito::where('id_cliente', $id_cliente)->get();
    }
}