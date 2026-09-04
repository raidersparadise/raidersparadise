<?php

namespace App\Services;

use App\Interfaces\FacturaInterface;
use App\Models\Factura;

class FacturaService implements FacturaInterface
{
    public function getAll()
    {
        return Factura::with('pedido')->get();
    }

    public function getById(int $id)
    {
        return Factura::with('pedido')->findOrFail($id);
    }

    public function create(array $datos)
    {
        return Factura::create($datos);
    }

    public function update(array $datos, int $id)
    {
        $factura = Factura::findOrFail($id);

        $factura->update($datos);

        return $factura->load('pedido');
    }

    public function delete(int $id)
    {
        $factura = Factura::findOrFail($id);

        $factura->delete();

        return true;
    }

    public function getByFechaFactura(string $fecha_factura)
    {
        return Factura::with('pedido')
            ->where('fecha_factura', 'LIKE', '%' . $fecha_factura . '%')
            ->get();
    }

    public function getByTotalFactura(float $total_factura)
    {
        return Factura::with('pedido')
            ->where('total_factura', $total_factura)
            ->get();
    }

    public function getByImpuesto(float $impuesto)
    {
        return Factura::with('pedido')
            ->where('impuesto', $impuesto)
            ->get();
    }

    public function getByEstadoFactura(string $estado_factura)
    {
        return Factura::with('pedido')
            ->where('estado_factura', 'LIKE', '%' . $estado_factura . '%')
            ->get();
    }

    public function getByPago(float $pago)
    {
        return Factura::with('pedido')
            ->where('pago', $pago)
            ->get();
    }

    public function getByMetodoPago(string $metodo_pago)
    {
        return Factura::with('pedido')
            ->where('metodo_pago', 'LIKE', '%' . $metodo_pago . '%')
            ->get();
    }

    public function getByPedido(int $id_pedido)
    {
        return Factura::with('pedido')
            ->where('id_pedido', $id_pedido)
            ->get();
    }
}