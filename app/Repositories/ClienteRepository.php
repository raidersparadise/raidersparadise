<?php

namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository extends BaseRepository
{
    public function __construct(Cliente $model)
    {
        parent::__construct($model);
    }

    public function getByName(string $nombre)
    {
        return $this->model->where(
            'nombre_cliente',
            'LIKE',
            '%' . $nombre . '%'
        )->get();
    }

    public function getByLastname(string $apellido)
    {
        return $this->model->where(
            'apellido_cliente',
            'LIKE',
            '%' . $apellido . '%'
        )->get();
    }
}