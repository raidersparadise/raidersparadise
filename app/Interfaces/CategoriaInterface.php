<?php

namespace App\Interfaces;

interface CategoriaInterface extends BaseInterface
{
    // Buscar categoría por nombre
    public function getByName(string $nombre);
}
