<?php

namespace App\Repositories;

use App\Models\DetallePedido;

class DetallePedidoRepository extends BaseRepository
{
    public function __construct(DetallePedido $model)
    {
        parent::__construct($model);
    }

    public function getAllWithRelations()
    {
        return $this->model
            ->with([
                'pedido',
                'producto'
            ])
            ->get();
    }

    public function getByIdWithRelations(int $id)
    {
        return $this->model
            ->with([
                'pedido',
                'producto'
            ])
            ->find($id);
    }

    public function getByCantidad(int $cantidad)
    {
        return $this->model
            ->with([
                'pedido',
                'producto'
            ])
            ->where('cantidad', $cantidad)
            ->get();
    }

    public function getByPrecioUnitario(float $precio_unitario)
    {
        return $this->model
            ->with([
                'pedido',
                'producto'
            ])
            ->where('precio_unitario', $precio_unitario)
            ->get();
    }

    public function getBySubTotal(float $sub_total)
    {
        return $this->model
            ->with([
                'pedido',
                'producto'
            ])
            ->where('sub_total', $sub_total)
            ->get();
    }

    public function getByPedido(int $id_pedido)
    {
        return $this->model
            ->with([
                'pedido',
                'producto'
            ])
            ->where('id_pedido', $id_pedido)
            ->get();
    }

    public function getByProducto(int $id_producto)
    {
        return $this->model
            ->with([
                'pedido',
                'producto'
            ])
            ->where('id_producto', $id_producto)
            ->get();
    }
}