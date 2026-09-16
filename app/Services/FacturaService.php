<?php

namespace App\Services;

use App\Interfaces\FacturaInterface;
use App\Repositories\FacturaRepository;

class FacturaService implements FacturaInterface
{
    protected $facturaRepository;

    public function __construct(FacturaRepository $facturaRepository)
    {
        $this->facturaRepository = $facturaRepository;
    }

    public function getAll()
    {
        return $this->facturaRepository
            ->getAllWithPedido();
    }

    public function getById(int $id)
    {
        return $this->facturaRepository
            ->getByIdWithPedido($id);
    }

    public function create(array $datos)
    {
        return $this->facturaRepository
            ->create($datos);
    }

    public function update(array $datos, int $id)
    {
        return $this->facturaRepository
            ->update($datos, $id);
    }

    public function delete(int $id)
    {
        return $this->facturaRepository
            ->delete($id);
    }

    public function getByFechaFactura(string $fecha_factura)
    {
        return $this->facturaRepository
            ->getByFechaFactura($fecha_factura);
    }

    public function getByTotalFactura(float $total_factura)
    {
        return $this->facturaRepository
            ->getByTotalFactura($total_factura);
    }

    public function getByImpuesto(float $impuesto)
    {
        return $this->facturaRepository
            ->getByImpuesto($impuesto);
    }

    public function getByEstadoFactura(string $estado_factura)
    {
        return $this->facturaRepository
            ->getByEstadoFactura($estado_factura);
    }

    public function getByPago(float $pago)
    {
        return $this->facturaRepository
            ->getByPago($pago);
    }

    public function getByMetodoPago(string $metodo_pago)
    {
        return $this->facturaRepository
            ->getByMetodoPago($metodo_pago);
    }

    public function getByPedido(int $id_pedido)
    {
        return $this->facturaRepository
            ->getByPedido($id_pedido);
    }
}