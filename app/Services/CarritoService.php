<?php

namespace App\Services;

use App\Interfaces\CarritoInterface;
use App\Repositories\CarritoRepository;

class CarritoService implements CarritoInterface
{
    protected $carritoRepository;

    public function __construct(CarritoRepository $carritoRepository)
    {
        $this->carritoRepository = $carritoRepository;
    }

    // Obtener todos los carritos
    public function getAll()
    {
        return $this->carritoRepository->getAll();
    }

    // Obtener carrito por ID
    public function getById(int $id)
    {
        return $this->carritoRepository->getById($id);
    }

    // Crear carrito
    public function create(array $datos)
    {
        return $this->carritoRepository->create($datos);
    }

    // Actualizar carrito
    public function update(array $datos, int $id)
    {
        $carritoActual = $this->carritoRepository->getById($id);

        if (!$carritoActual) {
            return null;
        }

        $sinCambios = true;

        foreach ($datos as $campo => $valor) {
            if ($carritoActual->$campo != $valor) {
                $sinCambios = false;
                break;
            }
        }

        if ($sinCambios) {
            return [
                'ya_actualizado' => true,
                'mensaje' => 'El carrito ya se encuentra actualizado',
                'carrito' => $carritoActual
            ];
        }

        $carritoActualizado = $this->carritoRepository->update($datos, $id);

        return [
            'ya_actualizado' => false,
            'mensaje' => 'Carrito actualizado correctamente',
            'carrito' => $carritoActualizado
        ];
    }

    // Eliminar carrito
    public function delete(int $id)
    {
        return $this->carritoRepository->delete($id);
    }

    // Buscar carritos por cliente
    public function getByCliente(int $id_cliente)
    {
        return $this->carritoRepository->getByCliente($id_cliente);
    }
}