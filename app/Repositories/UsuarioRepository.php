<?php

namespace App\Repositories;

use App\Interfaces\UsuarioInterface;
use App\Models\Usuario;

class UsuarioRepository extends BaseRepository implements UsuarioInterface
{
    public function __construct(Usuario $usuario)
    {
        parent::__construct($usuario);
    }

    public function getByName(string $nombre)
    {
        $usuarios = $this->model
            ->where('nombre_usuario', 'LIKE', '%' . $nombre . '%')
            ->get();

        if ($usuarios->isEmpty()) {
            return null;
        }

        return $usuarios;
    }

    public function getByEmail(string $email)
    {
        return $this->model
            ->where('email', $email)
            ->first();
    }

    public function getByRol(int $id_rol)
    {
        $usuarios = $this->model
            ->where('id_rol', $id_rol)
            ->get();

        if ($usuarios->isEmpty()) {
            return null;
        }

        return $usuarios;
    }

    public function getAll()
    {
        return $this->model
            ->with('rol')
            ->get();
    }

    public function getById(int $id)
    {
        return $this->model
            ->with('rol')
            ->find($id);
    }

    public function create(array $datos)
    {
        return $this->model
            ->create($datos)
            ->load('rol');
    }

    public function update(array $datos, int $id)
    {
        $usuario = $this->model->find($id);

        if (!$usuario) {
            return null;
        }

        $usuario->update($datos);

        return $usuario->fresh()->load('rol');
    }
}