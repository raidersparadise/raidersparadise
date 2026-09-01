<?php

namespace App\Interfaces;

interface PedidoInterface extends BaseInterface
{
    public function getByEstado(string $estado);

    public function getByFecha(string $fecha);

    public function getByTotal(float $total);

    public function getByCliente(int $id_cliente);
}