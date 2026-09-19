<?php

namespace App\Http\Controllers;

use App\Services\RolService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RolController extends Controller
{
    protected RolService $rolService;

    public function __construct(RolService $rolService)
    {
        $this->rolService = $rolService;
    }

    public function index()
    {
        return response()->json([
            'success' => 'Roles consultados correctamente',
            'data' => $this->rolService->getAll()
        ]);
    }

    public function show(int $id)
    {
        return response()->json([
            'success' => 'Rol encontrado correctamente',
            'data' => $this->rolService->getById($id)
        ]);
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'nombre_rol' => [
            'required',
            'string',
            'max:40',
            'unique:rol,nombre_rol',
        ],
        'descripcion' => [
            'required',
            'string',
        ],
    ]);

    $rol = $this->rolService->create($data);

    return response()->json([
        'success' => true,
        'message' => 'Rol creado correctamente',
        'data' => $rol
    ], 201);
}

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'nombre_rol' => [
                'sometimes',
                'string',
                'max:40',
                Rule::unique('rol', 'nombre_rol')
                    ->ignore($id, 'id_rol'),
            ],
            'descripcion' => 'sometimes|string',
        ]);

        return response()->json([
            'success' => 'Rol actualizado correctamente',
            'data' => $this->rolService->update($data, $id)
        ]);
    }

    public function destroy(int $id)
{
    $resultado = $this->rolService->delete($id);

    return $this->respuestaEliminacion(
        $resultado,
        'Rol'
    );
}

    public function getByNombreRol(string $nombre_rol)
    {
        return response()->json([
            'success' => 'Roles filtrados por nombre correctamente',
            'data' => $this->rolService->getByNombreRol($nombre_rol)
        ]);
    }

    public function getByDescripcion(string $descripcion)
    {
        return response()->json([
            'success' => 'Roles filtrados por descripción correctamente',
            'data' => $this->rolService->getByDescripcion($descripcion)
        ]);
    }
}
