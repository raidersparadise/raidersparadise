<?php

namespace App\Services;

use App\Interfaces\ProveedorInterface;

class ProveedorService
{
    public function __construct(
        private ProveedorInterface $proveedorRepository
    ) {}

    public function getAll()
    {
        return $this->proveedorRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->proveedorRepository->getById($id);
    }

    public function create(array $datos)
    {
        return $this->proveedorRepository->create($datos);
    }

    public function update(array $datos, int $id)
    {
        return $this->proveedorRepository->update($datos, $id);
    }

    public function delete(int $id)
    {
        return $this->proveedorRepository->delete($id);
    }

    public function getByNombreProveedor(string $nombre_proveedor)
    {
        return $this->proveedorRepository
            ->getByNombreProveedor($nombre_proveedor);
    }

    public function getByTelefonoProveedor(string $telefono_proveedor)
    {
        return $this->proveedorRepository
            ->getByTelefonoProveedor($telefono_proveedor);
    }

    public function getByDireccionProveedor(string $direccion_proveedor)
    {
        return $this->proveedorRepository
            ->getByDireccionProveedor($direccion_proveedor);
    }

    public function getByEmailProveedor(string $email_proveedor)
    {
        return $this->proveedorRepository
            ->getByEmailProveedor($email_proveedor);
    }
}