<?php

namespace App\Services;

use App\Interfaces\ProveedorInterface;
use App\Models\Proveedor;

class ProveedorService implements ProveedorInterface
{
    // Obtener todos los proveedores
    public function getAll()
    {
        return Proveedor::with('productos')->get();
    }

    // Obtener proveedor por ID
    public function getById(int $id)
    {
        return Proveedor::with('productos')->findOrFail($id);
    }

    // Crear un proveedor
    public function create(array $datos)
    {
        return Proveedor::create($datos);
    }

    // Actualizar un proveedor
    public function update(array $datos, int $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $proveedor->update($datos);

        return $proveedor->load('productos');
    }

    // Eliminar un proveedor
    public function delete(int $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $proveedor->delete();

        return true;
    }

    // Buscar proveedor por nombre
    public function getByNombreProveedor(string $nombre_proveedor)
    {
        return Proveedor::with('productos')
            ->where(
                'nombre_proveedor',
                'LIKE',
                '%' . $nombre_proveedor . '%'
            )
            ->get();
    }

    // Buscar proveedor por teléfono
    public function getByTelefonoProveedor(string $telefono_proveedor)
    {
        return Proveedor::with('productos')
            ->where(
                'telefono_proveedor',
                'LIKE',
                '%' . $telefono_proveedor . '%'
            )
            ->get();
    }

    // Buscar proveedor por dirección
    public function getByDireccionProveedor(string $direccion_proveedor)
    {
        return Proveedor::with('productos')
            ->where(
                'direccion_proveedor',
                'LIKE',
                '%' . $direccion_proveedor . '%'
            )
            ->get();
    }

    // Buscar proveedor por email
    public function getByEmailProveedor(string $email_proveedor)
    {
        return Proveedor::with('productos')
            ->where(
                'email_proveedor',
                'LIKE',
                '%' . $email_proveedor . '%'
            )
            ->get();
    }
}