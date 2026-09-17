<?php

namespace App\Repositories;

use App\Interfaces\CategoriaInterface;
use App\Models\Categoria;

class CategoriaRepository extends BaseRepository implements CategoriaInterface
{
    public function __construct(Categoria $categoria)
    {
        parent::__construct($categoria);
    }

    public function getAll()
    {
        return $this->model
            ->with('productos')
            ->get();
    }

    public function getById(int $id)
    {
        return $this->model
            ->with('productos')
            ->find($id);
    }

    public function create(array $datos)
    {
        return $this->model
            ->create($datos)
            ->load('productos');
    }

    public function update(array $datos, int $id)
    {
        $categoria = $this->model->find($id);

        if (!$categoria) {
            return null;
        }

        $categoria->update($datos);

        return $categoria
            ->fresh()
            ->load('productos');
    }

    public function getByNombreCategoria(string $nombre_categoria)
    {
        return $this->model
            ->with('productos')
            ->where(
                'nombre_categoria',
                'LIKE',
                '%' . $nombre_categoria . '%'
            )
            ->get();
    }

    public function getByDescripcionCategoria(string $descripcion_categoria)
    {
        return $this->model
            ->with('productos')
            ->where(
                'descripcion_categoria',
                'LIKE',
                '%' . $descripcion_categoria . '%'
            )
            ->get();
    }
}