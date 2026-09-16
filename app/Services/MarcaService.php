<?php

namespace App\Services;

use App\Interfaces\MarcaInterface;
use App\Repositories\MarcaRepository;

class MarcaService implements MarcaInterface
{
    protected $marcaRepository;

    public function __construct(MarcaRepository $marcaRepository)
    {
        $this->marcaRepository = $marcaRepository;
    }

    public function getAll()
    {
        return $this->marcaRepository->getAllWithProductos();
    }

    public function getById(int $id)
    {
        return $this->marcaRepository->getByIdWithProductos($id);
    }

    public function create(array $datos)
    {
        return $this->marcaRepository->create($datos);
    }

    public function update(array $datos, int $id)
    {
        return $this->marcaRepository->update($datos, $id);
    }

    public function delete(int $id)
    {
        return $this->marcaRepository->delete($id);
    }

    public function getByNombreMarca(string $nombre_marca)
    {
        return $this->marcaRepository->getByNombreMarca(
            $nombre_marca
        );
    }

    public function getByDescripcionMarca(string $descripcion_marca)
    {
        return $this->marcaRepository->getByDescripcionMarca(
            $descripcion_marca
        );
    }
}