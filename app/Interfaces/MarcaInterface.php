<?php

namespace App\Interfaces;

interface MarcaInterface extends BaseInterface
{
    public function getByNombreMarca(string $nombre_marca);

    public function getByDescripcionMarca(string $descripcion_marca);
}