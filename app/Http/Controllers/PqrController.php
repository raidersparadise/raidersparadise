<?php

namespace App\Http\Controllers;

use App\Services\PqrService;
use App\Http\Requests\Pqr\StorePqrRequest;
use App\Http\Requests\Pqr\UpdatePqrRequest;

class PqrController extends Controller
{
    protected $pqrService;

    public function __construct(PqrService $pqrService)
    {
        $this->pqrService = $pqrService;
    }

    /**
     * Listar todas las PQR.
     */
    public function index()
    {
        $pqr = $this->pqrService->getAll();

        return response()->json([
            'success' => 'PQR consultadas correctamente',
            'datos' => $pqr
        ], 200);
    }

    /**
     * Crear una nueva PQR.
     */
    public function store(StorePqrRequest $datos)
    {
        $pqr = $this->pqrService->create($datos->validated());

        return response()->json([
            'success' => 'PQR creada correctamente',
            'datosInsertado' => $pqr
        ], 201);
    }

    /**
     * Consultar una PQR por ID.
     */
    public function show(int $id)
    {
        $pqr = $this->pqrService->getById($id);

        return response()->json([
            'success' => 'PQR encontrada correctamente',
            'data' => $pqr
        ], 200);
    }

    /**
     * Actualizar una PQR.
     */
    public function update(UpdatePqrRequest $datosActualizar, int $id)
    {
        $pqr = $this->pqrService->update(
            $datosActualizar->validated(),
            $id
        );

        return response()->json([
            'success' => 'PQR actualizada correctamente',
            'data' => $pqr
        ], 200);
    }

    /**
     * Eliminar una PQR.
     */
    public function destroy(int $id)
    {
        $this->pqrService->delete($id);

        return response()->json([
            'success' => 'PQR eliminada correctamente'
        ], 200);
    }

    /**
     * Consultar PQR por usuario.
     */
    public function porUsuario(int $id_usuario)
    {
        $pqr = $this->pqrService->getByUsuario($id_usuario);

        return response()->json([
            'success' => 'PQR consultadas por usuario correctamente',
            'data' => $pqr
        ], 200);
    }

    /**
     * Consultar PQR por estado.
     */
    public function porEstado(string $estado)
    {
        $pqr = $this->pqrService->getByEstado($estado);

        return response()->json([
            'success' => 'PQR consultadas por estado correctamente',
            'data' => $pqr
        ], 200);
    }
}