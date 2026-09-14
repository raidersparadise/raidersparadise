<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use App\Http\Requests\Usuario\StoreUsuarioRequest;
use App\Http\Requests\Usuario\UpdateUsuarioRequest;

class UsuarioController extends Controller
{
    protected $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    /**
     * Listar todos los usuarios.
     */
    public function index()
    {
        $usuarios = $this->usuarioService->getAll();

        return response()->json([
            'success' => 'Usuarios consultados correctamente',
            'data' => $usuarios
        ], 200);
    }

    /**
     * Crear un nuevo usuario.
     */
    public function store(StoreUsuarioRequest $datos)
    {
        $usuario = $this->usuarioService->create(
            $datos->validated()
        );

        return response()->json([
            'success' => 'Usuario creado correctamente',
            'datosInsertado' => $usuario
        ], 201);
    }

    /**
     * Consultar un usuario por ID.
     */
    public function show(int $id)
    {
        $usuario = $this->usuarioService->getById($id);

        return response()->json([
            'success' => 'Usuario encontrado correctamente',
            'data' => $usuario
        ], 200);
    }

    /**
     * Actualizar un usuario.
     */
    public function update(UpdateUsuarioRequest $datosActualizar, int $id)
    {
        $usuario = $this->usuarioService->update(
            $datosActualizar->validated(),
            $id
        );

        return response()->json([
            'success' => 'Usuario actualizado correctamente',
            'data' => $usuario
        ], 200);
    }

    /**
     * Eliminar un usuario.
     */
    public function destroy(int $id)
    {
        $this->usuarioService->delete($id);

        return response()->json([
            'success' => 'Usuario eliminado correctamente'
        ], 200);
    }

    /**
     * Buscar usuarios por nombre.
     */
    public function getByName(string $nombre)
    {
        $usuarios = $this->usuarioService->getByName($nombre);

        return response()->json([
            'success' => 'Usuarios filtrados por nombre correctamente',
            'data' => $usuarios
        ], 200);
    }

    /**
     * Buscar usuario por email.
     */
    public function getByEmail(string $email)
    {
        $usuario = $this->usuarioService->getByEmail($email);

        return response()->json([
            'success' => 'Usuario consultado por email correctamente',
            'data' => $usuario
        ], 200);
    }

    /**
     * Buscar usuarios por rol.
     */
    public function getByRol(int $id_rol)
    {
        $usuarios = $this->usuarioService->getByRol($id_rol);

        return response()->json([
            'success' => 'Usuarios filtrados por rol correctamente',
            'data' => $usuarios
        ], 200);
    }
}