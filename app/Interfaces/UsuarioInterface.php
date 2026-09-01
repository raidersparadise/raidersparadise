<?php

namespace App\Interfaces;

interface UsuarioInterface extends BaseInterface
{
    // Buscar usuario por nombre
    public function getByName(string $nombre);

    // Buscar usuario por correo
    public function getByEmail(string $email);

    // Buscar usuarios por rol
    public function getByRol(int $id_rol);
}
