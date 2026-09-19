<?php

namespace App\Services;

use App\Interfaces\ClienteInterface;
use App\Repositories\ClienteRepository;

class ClienteService implements ClienteInterface
{
    protected $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    // Obtener todos los clientes
    public function getAll()
    {
        return $this->clienteRepository->getAll();
    }

    // Obtener cliente por ID
    public function getById(int $id)
    {
        return $this->clienteRepository->getById($id);
    }

    // Crear cliente
    public function create(array $datos)
    {
        return $this->clienteRepository->create($datos);
    }

    // Actualizar cliente
    public function update(array $datos, int $id)
    {
        $clienteActual = $this->clienteRepository->getById($id);

        if (!$clienteActual) {
            return null;
        }

        $sinCambios = true;

        foreach ($datos as $campo => $valor) {
            if ($clienteActual->$campo != $valor) {
                $sinCambios = false;
                break;
            }
        }

        if ($sinCambios) {
            return [
                'ya_actualizado' => true,
                'mensaje' => 'El cliente ya se encuentra actualizado',
                'cliente' => $clienteActual
            ];
        }

        $clienteActualizado = $this->clienteRepository->update($datos, $id);

        return [
            'ya_actualizado' => false,
            'mensaje' => 'Cliente actualizado correctamente',
            'cliente' => $clienteActualizado
        ];
    }

    // Eliminar cliente
    public function delete(int $id)
    {
        return $this->clienteRepository->delete($id);
    }

    // Buscar clientes por nombre
    public function getByName(string $nombre)
    {
        return $this->clienteRepository->getByName($nombre);
    }

    // Buscar clientes por apellido
    public function getByLastname(string $apellido)
    {
        return $this->clienteRepository->getByLastname($apellido);
    }
}