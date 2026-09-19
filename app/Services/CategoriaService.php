<?php

namespace App\Services;

use App\Interfaces\CategoriaInterface;
use App\Models\Categoria;

class CategoriaService implements CategoriaInterface
{
    public function __construct(
        private CategoriaInterface $categoriaRepository
    ) {}

    public function getAll()
    {
        return $this->categoriaRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->categoriaRepository->getById($id);
    }

    public function create(array $datos)
    {
        return $this->categoriaRepository->create($datos);
    }

    public function update(array $datos, int $id)
    {
        $categoriaActual = $this->categoriaRepository->getById($id);

        if (!$categoriaActual) {
            return null;
        }

        $sinCambios = true;

        foreach ($datos as $campo => $valor) {
            if ($categoriaActual->$campo != $valor) {
                $sinCambios = false;
                break;
            }
        }

        if ($sinCambios) {
            return [
                'ya_actualizado' => true,
                'mensaje' => 'La categoría ya se encuentra actualizada',
                'categoria' => $categoriaActual
            ];
        }

        $categoriaActualizada = $this->categoriaRepository->update($datos, $id);

        return [
            'ya_actualizado' => false,
            'mensaje' => 'Categoría actualizada correctamente',
            'categoria' => $categoriaActualizada
        ];
    }

    public function delete(int $id)
    {
        return $this->categoriaRepository->delete($id);
    }

    public function getByNombreCategoria(string $nombre_categoria)
    {
        return $this->categoriaRepository
            ->getByNombreCategoria($nombre_categoria);
    }

    public function getByDescripcionCategoria(string $descripcion_categoria)
    {
        return $this->categoriaRepository
            ->getByDescripcionCategoria($descripcion_categoria);
    }
}