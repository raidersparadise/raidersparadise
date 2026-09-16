<?php

namespace App\Services;

use App\Interfaces\DetalleCarritoInterface;
use App\Repositories\DetalleCarritoRepository;

class DetalleCarritoService implements DetalleCarritoInterface
{
    protected $detalleCarritoRepository;

    public function __construct(
        DetalleCarritoRepository $detalleCarritoRepository
    ) {
        $this->detalleCarritoRepository = $detalleCarritoRepository;
    }

    // Obtener todos los detalles
    public function getAll()
    {
        return $this->detalleCarritoRepository->getAll();
    }

    // Obtener detalle por ID
    public function getById(int $id)
    {
        return $this->detalleCarritoRepository->getById($id);
    }

    // Crear detalle
    public function create(array $datos)
    {
        return $this->detalleCarritoRepository->create($datos);
    }

    // Actualizar detalle
    public function update(array $datos, int $id)
    {
        return $this->detalleCarritoRepository->update($datos, $id);
    }

    // Eliminar detalle
    public function delete(int $id)
    {
        return $this->detalleCarritoRepository->delete($id);
    }

    // Buscar por carrito
    public function getByCarrito(int $id_carrito)
    {
        return $this->detalleCarritoRepository->getByCarrito($id_carrito);
    }

    // Buscar por producto
    public function getByProducto(int $id_producto)
    {
        return $this->detalleCarritoRepository->getByProducto($id_producto);
    }

    // Obtener detalles con sus relaciones
    public function getAllWithRelations()
    {
        return $this->detalleCarritoRepository->getAllWithRelations();
    }
}