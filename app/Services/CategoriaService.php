<?php

namespace App\Services;

use App\Interfaces\CategoriaInterface;
use App\Models\Categoria;

class CategoriaService implements CategoriaInterface
{
    public function getAll()
    {
        return Categoria::all();
    }

    public function getById(int $id)
    {
        return Categoria::findOrFail($id);
    }

    public function create(array $datos)
    {
        return Categoria::create($datos);
    }

    public function update(array $datos, int $id)
    {
        $categoria = Categoria::findOrFail($id);

        $categoria->update($datos);

        return $categoria;
    }

    public function delete(int $id)
    {
        $categoria = Categoria::findOrFail($id);

        return $categoria->delete();
    }

    public function getByNombreCategoria(string $nombre_categoria)
    {
        return Categoria::where(
            'nombre_categoria',
            $nombre_categoria
        )->get();
    }

    public function getByDescripcionCategoria(string $descripcion_categoria)
    {
        return Categoria::where(
            'descripcion_categoria',
            $descripcion_categoria
        )->get();
    }
}