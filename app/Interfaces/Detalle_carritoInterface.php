<?php

namespace App\Interfaces;

interface Detalle_carritoInterface extends BaseInterface
{
    // Buscar detalles por carrito
    public function getByCarrito(int $id_carrito);

    // Buscar detalle por producto
    public function getByProducto(int $id_producto);
}