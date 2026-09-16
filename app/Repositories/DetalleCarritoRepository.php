<?php

namespace App\Repositories;

use App\Models\DetalleCarrito;

class DetalleCarritoRepository extends BaseRepository
{
    public function __construct(DetalleCarrito $model)
    {
        parent::__construct($model);
    }

    public function getByCarrito(int $id_carrito)
    {
        return $this->model->where(
            'id_carrito',
            $id_carrito
        )->get();
    }

    public function getByProducto(int $id_producto)
    {
        return $this->model->where(
            'id_producto',
            $id_producto
        )->get();
    }

    public function getAllWithRelations()
    {
        return $this->model->with([
            'carrito',
            'producto'
        ])->get();
    }
}