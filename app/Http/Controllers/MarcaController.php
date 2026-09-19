<?php

namespace App\Http\Controllers;

use App\Services\MarcaService;
use App\Http\Requests\Marca\StoreMarcaRequest;
use App\Http\Requests\Marca\UpdateMarcaRequest;

class MarcaController extends Controller
{
    protected $marcaService;

    public function __construct(MarcaService $marcaService)
    {
        $this->marcaService = $marcaService;
    }

    /**
     * Listar todas las marcas.
     */
    public function index()
    {
        $marcas = $this->marcaService->getAll();

        return response()->json([
            'success' => 'Marcas consultadas correctamente',
            'data' => $marcas
        ], 200);
    }

    /**
     * Crear una nueva marca.
     */
    public function store(StoreMarcaRequest $datos)
    {
        $marca = $this->marcaService->create($datos->validated());

        return response()->json([
            'success' => 'Marca creada correctamente',
            'datosInsertado' => $marca
        ], 201);
    }

    /**
     * Consultar una marca por ID.
     */
    public function show(int $id)
    {
        $marca = $this->marcaService->getById($id);

        return response()->json([
            'success' => 'Marca encontrada correctamente',
            'data' => $marca
        ], 200);
    }

    /**
     * Actualizar una marca.
     */
    public function update(UpdateMarcaRequest $datosActualizar, int $id)
    {
        $marca = $this->marcaService->update(
            $datosActualizar->validated(),
            $id
        );

        return response()->json([
            'success' => 'Marca actualizada correctamente',
            'data' => $marca
        ], 200);
    }

    /**
     * Eliminar una marca.
     */
    public function destroy(int $id)
    {
        $resultado = $this->marcaService->delete($id);

        if ($resultado['status'] === 'deleted') {
            return response()->json([
                'success' => true,
                'message' => 'Marca eliminada correctamente'
            ], 200);
        }

        if ($resultado['status'] === 'already_deleted') {
            return response()->json([
                'success' => false,
                'message' => 'Marca eliminada'
            ], 410);
        }

        return response()->json([
            'success' => false,
            'message' => 'Marca no encontrada'
        ], 404);
    }   
}