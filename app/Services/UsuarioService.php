<?php

namespace App\Services;

use App\Interfaces\UsuarioInterface;
use Illuminate\Support\Facades\Hash;

class UsuarioService
{
    public function __construct(
        private UsuarioInterface $usuarioRepository
    ) {}

    public function getAll()
    {
        return $this->usuarioRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->usuarioRepository->getById($id);
    }

    public function create(array $datos)
    {
        $datos['password'] = Hash::make($datos['password']);

        return $this->usuarioRepository->create($datos);
    }

    public function update(array $datos, int $id)
    {
        if (isset($datos['password'])) {
            $datos['password'] = Hash::make($datos['password']);
        }

        return $this->usuarioRepository->update($datos, $id);
    }

    public function delete(int $id)
    {
        return $this->usuarioRepository->delete($id);
    }

    public function getByName(string $nombre)
    {
        return $this->usuarioRepository->getByName($nombre);
    }

    public function getByEmail(string $email)
    {
        return $this->usuarioRepository->getByEmail($email);
    }

    public function getByRol(int $id_rol)
    {
        return $this->usuarioRepository->getByRol($id_rol);
    }
}