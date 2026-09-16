<?php

namespace App\Repositories;

use App\Interfaces\ProveedorInterface;
use App\Models\Proveedor;

class ProveedorRepository extends BaseRepository implements ProveedorInterface
{
    public function __construct(Proveedor $proveedor)
    {
        parent::__construct($proveedor);
    }

    public function getAll()
    {
        return $this->model
            ->with('productos')
            ->get();
    }

    public function getById(int $id)
    {
        return $this->model
            ->with('productos')
            ->find($id);
    }

    public function create(array $datos)
    {
        return $this->model
            ->create($datos)
            ->load('productos');
    }

    public function update(array $datos, int $id)
    {
        $proveedor = $this->model->find($id);

        if (!$proveedor) {
            return null;
        }

        $proveedor->update($datos);

        return $proveedor->fresh()->load('productos');
    }

    public function getByNombreProveedor(string $nombre_proveedor)
    {
        $proveedores = $this->model
            ->where(
                'nombre_proveedor',
                'LIKE',
                '%' . $nombre_proveedor . '%'
            )
            ->get();

        if ($proveedores->isEmpty()) {
            return null;
        }

        return $proveedores;
    }

    public function getByTelefonoProveedor(string $telefono_proveedor)
    {
        $proveedores = $this->model
            ->where(
                'telefono_proveedor',
                'LIKE',
                '%' . $telefono_proveedor . '%'
            )
            ->get();

        if ($proveedores->isEmpty()) {
            return null;
        }

        return $proveedores;
    }

    public function getByDireccionProveedor(string $direccion_proveedor)
    {
        $proveedores = $this->model
            ->where(
                'direccion_proveedor',
                'LIKE',
                '%' . $direccion_proveedor . '%'
            )
            ->get();

        if ($proveedores->isEmpty()) {
            return null;
        }

        return $proveedores;
    }

    public function getByEmailProveedor(string $email_proveedor)
    {
        $proveedores = $this->model
            ->where(
                'email_proveedor',
                'LIKE',
                '%' . $email_proveedor . '%'
            )
            ->get();

        if ($proveedores->isEmpty()) {
            return null;
        }

        return $proveedores;
    }
}