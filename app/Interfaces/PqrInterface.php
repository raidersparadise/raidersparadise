<?php

namespace App\Interfaces;

interface PqrInterface extends BaseInterface
{
    // Buscar PQR por usuario
    public function getByUsuario(int $id_usuario);

    // Buscar PQR por estado
    public function getByEstado(string $estado);
}