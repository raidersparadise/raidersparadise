<?php

namespace App\Http\Controllers;

use App\Services\RolService;
use App\Http\Requests\Rol\StoreRolRequest;
use App\Http\Requests\Rol\UpdateRolRequest;

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

    public function store(StoreRolRequest $request)
    {
        $data = $request->validated();

        return response()->json([
            'success' => 'Rol creado correctamente',
            'data' => $this->rolService->create($data)
        ], 201);
    }

    public function update(UpdateRolRequest $request, int $id)
    {
        $data = $request->validated();

        $resultado = $this->rolService->update($data, $id);

        // Si el rol no existe
        if ($resultado === null) {
            return response()->json([
                'message' => 'Rol no encontrado'
            ], 404);
        }

        // Si el rol ya tenía exactamente los mismos datos
        if ($resultado['ya_actualizado'] === true) {
            return response()->json([
                'message' => 'El rol ya se encuentra actualizado',
                'data' => $resultado['rol']
            ]);
        }

        // Si realmente hubo cambios
        return response()->json([
            'message' => 'Rol actualizado correctamente',
            'data' => $resultado['rol']
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