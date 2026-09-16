<?php

namespace App\Services;

use App\Interfaces\DetallePedidoInterface;
use App\Repositories\DetallePedidoRepository;

class DetallePedidoService implements DetallePedidoInterface
{
    protected $detallePedidoRepository;

    public function __construct(
        DetallePedidoRepository $detallePedidoRepository
    ) {
        $this->detallePedidoRepository = $detallePedidoRepository;
    }

    public function getAll()
    {
        return $this->detallePedidoRepository
            ->getAllWithRelations();
    }

    public function getById(int $id)
    {
        return $this->detallePedidoRepository
            ->getByIdWithRelations($id);
    }

    public function create(array $datos)
    {
        return $this->detallePedidoRepository
            ->create($datos);
    }

    public function update(array $datos, int $id)
    {
        return $this->detallePedidoRepository
            ->update($datos, $id);
    }

    public function delete(int $id)
    {
        return $this->detallePedidoRepository
            ->delete($id);
    }

    public function getByCantidad(int $cantidad)
    {
        return $this->detallePedidoRepository
            ->getByCantidad($cantidad);
    }

    public function getByPrecioUnitario(float $precio_unitario)
    {
        return $this->detallePedidoRepository
            ->getByPrecioUnitario($precio_unitario);
    }

    public function getBySubTotal(float $sub_total)
    {
        return $this->detallePedidoRepository
            ->getBySubTotal($sub_total);
    }

    public function getByPedido(int $id_pedido)
    {
        return $this->detallePedidoRepository
            ->getByPedido($id_pedido);
    }

    public function getByProducto(int $id_producto)
    {
        return $this->detallePedidoRepository
            ->getByProducto($id_producto);
    }
}