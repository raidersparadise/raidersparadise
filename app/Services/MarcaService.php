<?php

namespace App\Services;

use App\Interfaces\MarcaInterface;
use App\Models\Marca;

class MarcaService implements MarcaInterface
{
    // Obtener todas las marcas
    public function getAll()
    {
        return Marca::with('productos')->get();
    }

    // Obtener una marca por ID
    public function getById(int $id)
    {
        return Marca::with('productos')->findOrFail($id);
    }

    // Crear una marca
    public function create(array $datos)
    {
        return Marca::create($datos);
    }

    // Actualizar una marca
    public function update(array $datos, int $id)
    {
        $marca = Marca::findOrFail($id);

        $marca->update($datos);

        return $marca->load('productos');
    }

    // Eliminar una marca
    public function delete(int $id)
    {
        $marca = Marca::findOrFail($id);

        $marca->delete();

        return true;
    }

    // Buscar marca por nombre
    public function getByNombreMarca(string $nombre_marca)
    {
        return Marca::with('productos')
            ->where('nombre_marca', 'like', '%' . $nombre_marca . '%')
            ->get();
    }

    // Buscar marca por descripción
    public function getByDescripcionMarca(string $descripcion_marca)
    {
        return Marca::with('productos')
            ->where('descripcion_marca', 'like', '%' . $descripcion_marca . '%')
            ->get();
    }
}