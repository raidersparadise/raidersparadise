<?php

namespace App\Services;

use App\Interfaces\ClienteInterface;
use App\Models\Cliente;

class ClienteService implements ClienteInterface
{
    // Obtener todos los clientes
    public function getAll()
    {
        return Cliente::all();
    }

    // Obtener cliente por ID
    public function getById(int $id)
    {
        return Cliente::findOrFail($id);
    }

    // Crear un cliente
    public function create(array $datos)
    {
        return Cliente::create($datos);
    }

    // Actualizar un cliente
    public function update(array $datos, int $id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->update($datos);

        return $cliente;
    }

    // Eliminar un cliente
    public function delete(int $id)
    {
        $cliente = Cliente::findOrFail($id);

        return $cliente->delete();
    }

    // Buscar clientes por nombre
    public function getByName(string $nombre)
    {
        return Cliente::where(
            'nombre_cliente',
            'LIKE',
            '%' . $nombre . '%'
        )->get();
    }

    // Buscar clientes por apellido
    public function getByLastname(string $apellido)
    {
        return Cliente::where(
            'apellido_cliente',
            'LIKE',
            '%' . $apellido . '%'
        )->get();
    }
}


