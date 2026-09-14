<?php

namespace App\Interfaces;

interface DetallePedidoInterface extends BaseInterface
{
    public function getByCantidad(int $cantidad);

    public function getByPrecioUnitario(float $precio_unitario);

    public function getBySubTotal(float $sub_total);

    public function getByPedido(int $id_pedido);

    public function getByProducto(int $id_producto);
}

