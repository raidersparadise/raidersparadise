<?php

namespace App\Services;

use App\Interfaces\PqrInterface;
use App\Models\Pqr;

class PqrService implements PqrInterface
{
    // Obtener todas las PQR
    public function getAll()
    {
        return Pqr::with([
            'usuario',
            'cliente'
        ])->get();
    }

    // Obtener una PQR por ID
    public function getById(int $id)
    {
        return Pqr::with([
            'usuario',
            'cliente'
        ])->findOrFail($id);
    }

    // Crear una PQR
    public function create(array $datos)
    {
        return Pqr::create($datos);
    }

    // Actualizar una PQR
    public function update(array $datos, int $id)
    {
        $pqr = Pqr::findOrFail($id);

        $pqr->update($datos);

        return $pqr->load([
            'usuario',
            'cliente'
        ]);
    }

    // Eliminar una PQR
    public function delete(int $id)
    {
        $pqr = Pqr::findOrFail($id);

        $pqr->delete();

        return true;
    }
}