<?php

namespace App\Interfaces;

interface ProveedorInterface extends BaseInterface
{
    public function getByNombreProveedor(string $nombre_proveedor);

    public function getByTelefonoProveedor(string $telefono_proveedor);

    public function getByDireccionProveedor(string $direccion_proveedor);

    public function getByEmailProveedor(string $email_proveedor);
}
