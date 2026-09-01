<?php

namespace App\Interfaces;

interface FacturaInterface extends BaseInterface
{
    public function getByFechaFactura(string $fecha_factura);

    public function getByTotalFactura(float $total_factura);

    public function getByImpuesto(float $impuesto);

    public function getByEstadoFactura(string $estado_factura);

    public function getByPago(float $pago);

    public function getByMetodoPago(string $metodo_pago);

    public function getByPedido(int $id_pedido);
}

