<?php

namespace App\Interfaces;

interface RolInterface extends BaseInterface
{
    public function getByNombreRol(string $nombre_rol);

    public function getByDescripcion(string $descripcion);
}
