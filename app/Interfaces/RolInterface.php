<?php

namespace App\Interfaces;

interface RolInterface extends BaseInterface
{
    public function getByName(string $nombre_rol);
}