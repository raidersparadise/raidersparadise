<?php

namespace App\Repositories;

use App\Models\Factura;

class FacturaRepository extends BaseRepository
{
    public function __construct(Factura $model)
    {
        parent::__construct($model);
    }

    public function getAllWithPedido()
    {
        return $this->model
            ->with('pedido')
            ->get();
    }

    public function getByIdWithPedido(int $id)
    {
        return $this->model
            ->with('pedido')
            ->find($id);
    }

    public function getByFechaFactura(string $fecha_factura)
    {
        return $this->model
            ->with('pedido')
            ->where(
                'fecha_factura',
                'LIKE',
                '%' . $fecha_factura . '%'
            )
            ->get();
    }

    public function getByTotalFactura(float $total_factura)
    {
        return $this->model
            ->with('pedido')
            ->where('total_factura', $total_factura)
            ->get();
    }

    public function getByImpuesto(float $impuesto)
    {
        return $this->model
            ->with('pedido')
            ->where('impuesto', $impuesto)
            ->get();
    }

    public function getByEstadoFactura(string $estado_factura)
    {
        return $this->model
            ->with('pedido')
            ->where(
                'estado_factura',
                'LIKE',
                '%' . $estado_factura . '%'
            )
            ->get();
    }

    public function getByPago(float $pago)
    {
        return $this->model
            ->with('pedido')
            ->where('pago', $pago)
            ->get();
    }

    public function getByMetodoPago(string $metodo_pago)
    {
        return $this->model
            ->with('pedido')
            ->where(
                'metodo_pago',
                'LIKE',
                '%' . $metodo_pago . '%'
            )
            ->get();
    }

    public function getByPedido(int $id_pedido)
    {
        return $this->model
            ->with('pedido')
            ->where('id_pedido', $id_pedido)
            ->get();
    }
}