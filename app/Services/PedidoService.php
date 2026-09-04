<?php

namespace App\Services;

use App\Interfaces\PedidoInterface;
use App\Models\Pedido;

class PedidoService implements PedidoInterface
{
    // Obtener todos los pedidos
    public function getAll()
    {
        return Pedido::all();
    }

    // Obtener pedido por ID
    public function getById(int $id)
    {
        return Pedido::findOrFail($id);
    }

    // Crear pedido
    public function create(array $datos)
    {
        return Pedido::create($datos);
    }

    // Actualizar pedido
    public function update(array $datos, int $id)
    {
        $pedido = Pedido::findOrFail($id);

        $pedido->update($datos);

        return $pedido;
    }

    // Eliminar pedido
    public function delete(int $id)
    {
        $pedido = Pedido::findOrFail($id);

        return $pedido->delete();
    }

    // Buscar pedidos por estado
    public function getByEstado(string $estado)
    {
        return Pedido::where('estado', $estado)->get();
    }

    // Buscar pedidos por fecha
    public function getByFecha(string $fecha)
    {
        return Pedido::whereDate('fecha', $fecha)->get();
    }

    // Buscar pedidos por total
    public function getByTotal(float $total)
    {
        return Pedido::where('total', $total)->get();
    }

    // Buscar pedidos por cliente
    public function getByCliente(int $id_cliente)
    {
        return Pedido::where('id_cliente', $id_cliente)->get();
    }
}