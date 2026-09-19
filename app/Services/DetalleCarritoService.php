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
        $detalleActual = $this->detalleCarritoRepository->getById($id);

        if (!$detalleActual) {
            return null;
        }

        $sinCambios = true;

        foreach ($datos as $campo => $valor) {
            if ($detalleActual->$campo != $valor) {
                $sinCambios = false;
                break;
            }
        }

        if ($sinCambios) {
            return [
                'ya_actualizado' => true,
                'mensaje' => 'El detalle del carrito ya se encuentra actualizado',
                'detalle' => $detalleActual
            ];
        }

        $detalleActualizado = $this->detalleCarritoRepository->update($datos, $id);

        return [
            'ya_actualizado' => false,
            'mensaje' => 'Detalle del carrito actualizado correctamente',
            'detalle' => $detalleActualizado
        ];
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