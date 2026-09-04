<?php

namespace App\Interfaces;

interface CategoriaInterface extends BaseInterface
{
    public function getByNombreCategoria(string $nombre_categoria);

    public function getByDescripcionCategoria(string $descripcion_categoria);
}

