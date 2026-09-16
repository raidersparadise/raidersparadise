<?php

namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository
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

    // Crear cliente
    public function create(array $datos)
    {
        return Cliente::create($datos);
    }

    // Actualizar cliente
    public function update(array $datos, int $id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->update($datos);

        return $cliente;
    }

    // Eliminar cliente
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