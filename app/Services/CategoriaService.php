<?php

namespace App\Services;

use App\Interfaces\CategoriaInterface;

class CategoriaService
{
    protected CategoriaInterface $categoriaRepository;

    public function __construct(CategoriaInterface $categoriaRepository)
    {
        $this->categoriaRepository = $categoriaRepository;
    }

    public function getAll()
    {
        return $this->categoriaRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->categoriaRepository->getById($id);
    }

    public function create(array $data)
    {
        return $this->categoriaRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->categoriaRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->categoriaRepository->delete($id);
    }

    public function getByNombreCategoria(string $nombre_categoria)
    {
        return $this->categoriaRepository->getByNombreCategoria($nombre_categoria);
    }

    public function getByDescripcionCategoria(string $descripcion_categoria)
    {
        return $this->categoriaRepository->getByDescripcionCategoria($descripcion_categoria);
    }
}