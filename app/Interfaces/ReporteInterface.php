<?php

namespace App\Interfaces;

interface ReporteInterface extends BaseInterface
{
    // Buscar reportes por usuario
    public function getByUsuario(int $id_usuario);
}