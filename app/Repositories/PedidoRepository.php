<?php

namespace App\Repositories;

use App\Models\Pedido;

class PedidoRepository extends BaseRepository
{
    public function __construct(Pedido $model)
    {
        parent::__construct($model);
    }

    public function getByEstado(string $estado)
    {
        return $this->model->where('estado', $estado)->get();
    }

    public function getByFecha(string $fecha)
    {
        return $this->model->whereDate('fecha', $fecha)->get();
    }

    public function getByTotal(float $total)
    {
        return $this->model->where('total', $total)->get();
    }

    public function getByCliente(int $id_cliente)
    {
        return $this->model->where('id_cliente', $id_cliente)->get();
    }
}