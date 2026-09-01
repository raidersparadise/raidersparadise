<?php

namespace App\Interfaces;

interface CarritoInterface extends BaseInterface
{
    // Buscar carrito por usuario
    public function getByUsuario(int $id_usuario);
}