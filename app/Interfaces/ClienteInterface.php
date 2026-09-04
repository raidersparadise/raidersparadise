<?php

namespace App\Interfaces;

interface ClienteInterface extends BaseInterface
{
    // Buscar cliente por nombre
    public function getByName(string $nombre);

    // Buscar cliente por apellido
    public function getByLastname(string $apellido);

}
