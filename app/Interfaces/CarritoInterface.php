<?php

namespace App\Interfaces;

interface CarritoInterface extends BaseInterface
{
    // Buscar carritos por cliente
    public function getByCliente(int $id_cliente);
}