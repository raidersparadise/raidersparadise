<?php

namespace App\Interfaces;

interface InventarioInterface extends BaseInterface
{
    public function getByCantidadDisponible(int $cantidad_disponible);

    public function getByCantidadMinima(int $cantidad_minima);

    public function getByProducto(int $id_producto);
}
