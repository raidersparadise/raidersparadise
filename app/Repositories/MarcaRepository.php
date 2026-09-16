<?php

namespace App\Repositories;

use App\Models\Marca;

class MarcaRepository extends BaseRepository
{
    public function __construct(Marca $model)
    {
        parent::__construct($model);
    }

    public function getByNombreMarca(string $nombre_marca)
    {
        return $this->model
            ->with('productos')
            ->where(
                'nombre_marca',
                'like',
                '%' . $nombre_marca . '%'
            )
            ->get();
    }

    public function getByDescripcionMarca(string $descripcion_marca)
    {
        return $this->model
            ->with('productos')
            ->where(
                'descripcion_marca',
                'like',
                '%' . $descripcion_marca . '%'
            )
            ->get();
    }

    public function getAllWithProductos()
    {
        return $this->model
            ->with('productos')
            ->get();
    }

    public function getByIdWithProductos(int $id)
    {
        return $this->model
            ->with('productos')
            ->find($id);
    }
}