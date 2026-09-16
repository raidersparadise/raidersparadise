<?php

namespace App\Repositories;

use App\Models\Carrito;

class CarritoRepository extends BaseRepository
{
    public function __construct(Carrito $model)
    {
        parent::__construct($model);
    }

    public function getByCliente(int $id_cliente)
    {
        return $this->model->where(
            'id_cliente',
            $id_cliente
        )->get();
    }
}