<?php

namespace App\Services;

use App\Interfaces\DetallePedidoInterface;
use App\Models\DetallePedido;

class DetallePedidoService implements DetallePedidoInterface
{
    // Obtener todos los detalles de pedido
    public function getAll()
    {
        return DetallePedido::with([
            'pedido',
            'producto'
        ])->get();
    }

    // Obtener un detalle de pedido por ID
    public function getById(int $id)
    {
        return DetallePedido::with([
            'pedido',
            'producto'
        ])->findOrFail($id);
    }

    // Crear un detalle de pedido
    public function create(array $datos)
    {
        return DetallePedido::create($datos);
    }

    // Actualizar un detalle de pedido
    public function update(array $datos, int $id)
    {
        $detallePedido = DetallePedido::findOrFail($id);

        $detallePedido->update($datos);

        return $detallePedido->load([
            'pedido',
            'producto'
        ]);
    }

    // Eliminar un detalle de pedido
    public function delete(int $id)
    {
        $detallePedido = DetallePedido::findOrFail($id);

        $detallePedido->delete();

        return true;
    }

    // Buscar por cantidad
    public function getByCantidad(int $cantidad)
    {
        return DetallePedido::with([
            'pedido',
            'producto'
        ])
        ->where('cantidad', $cantidad)
        ->get();
    }

    // Buscar por precio unitario
    public function getByPrecioUnitario(float $precio_unitario)
    {
        return DetallePedido::with([
            'pedido',
            'producto'
        ])
        ->where('precio_unitario', $precio_unitario)
        ->get();
    }

    // Buscar por subtotal
    public function getBySubTotal(float $sub_total)
    {
        return DetallePedido::with([
            'pedido',
            'producto'
        ])
        ->where('sub_total', $sub_total)
        ->get();
    }

    // Buscar por pedido
    public function getByPedido(int $id_pedido)
    {
        return DetallePedido::with([
            'pedido',
            'producto'
        ])
        ->where('id_pedido', $id_pedido)
        ->get();
    }

    // Buscar por producto
    public function getByProducto(int $id_producto)
    {
        return DetallePedido::with([
            'pedido',
            'producto'
        ])
        ->where('id_producto', $id_producto)
        ->get();
    }
}