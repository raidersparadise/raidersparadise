<?php

namespace App\Services;

use App\Interfaces\RolInterface;

class RolService implements RolInterface
{
    public function __construct(
        private RolInterface $rolRepository
    ) {}

    public function getAll()
    {
        return $this->rolRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->rolRepository->getById($id);
    }

    public function create(array $datos)
    {
        return $this->rolRepository->create($datos);
    }

    public function update(array $datos, int $id)
    {
        // Buscar el rol actual
        $rolActual = $this->rolRepository->getById($id);

        // Si el rol no existe
        if (!$rolActual) {
            return null;
        }

        // Verificar si los datos son iguales a los actuales
        $sinCambios = true;

        foreach ($datos as $campo => $valor) {
            if ($rolActual->$campo != $valor) {
                $sinCambios = false;
                break;
            }
        }

        // Si no hubo ningún cambio
        if ($sinCambios) {
            return [
                'ya_actualizado' => true,
                'mensaje' => 'El rol ya se encuentra actualizado',
                'rol' => $rolActual
            ];
        }

        // Si hubo cambios, actualizar
        $rolActualizado = $this->rolRepository->update($datos, $id);

        return [
            'ya_actualizado' => false,
            'mensaje' => 'Rol actualizado correctamente',
            'rol' => $rolActualizado
        ];
    }

    public function delete(int $id)
    {
        return $this->rolRepository->delete($id);
    }

    public function getByNombreRol(string $nombre_rol)
    {
        return $this->rolRepository->getByNombreRol($nombre_rol);
    }

    public function getByDescripcion(string $descripcion)
    {
        return $this->rolRepository->getByDescripcion($descripcion);
    }
}