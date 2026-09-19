<?php

namespace App\Http\Controllers;

use App\Services\InventarioService;
use App\Http\Requests\Inventario\StoreInventarioRequest;
use App\Http\Requests\Inventario\UpdateInventarioRequest;

class InventarioController extends Controller
{
    protected $inventarioService;

    public function __construct(InventarioService $inventarioService)
    {
        $this->inventarioService = $inventarioService;
    }

    public function index()
    {
        $inventarios = $this->inventarioService->getAll();

        return response()->json([
            'success' => 'Inventarios consultados correctamente',
            'data' => $inventarios
        ], 200);
    }

    public function store(StoreInventarioRequest $datos)
    {
        $inventario = $this->inventarioService->create(
            $datos->validated()
        );

        return response()->json([
            'success' => 'Inventario creado correctamente',
            'datosInsertado' => $inventario
        ], 201);
    }

    public function show(int $id)
    {
        $inventario = $this->inventarioService->getById($id);

        return response()->json([
            'success' => 'Inventario encontrado correctamente',
            'data' => $inventario
        ], 200);
    }

    public function update(UpdateInventarioRequest $datosActualizar, int $id)
    {
        $inventario = $this->inventarioService->update(
            $datosActualizar->validated(),
            $id
        );

        return response()->json([
            'success' => 'Inventario actualizado correctamente',
            'data' => $inventario
        ], 200);
    }

   public function destroy(int $id)
{
    $resultado = $this->inventarioService->delete($id);

    if (!$resultado['success']) {
        return response()->json([
            'success' => false,
            'message' => $resultado['message'],
            'data' => null
        ], 404);
    }

    return response()->json([
        'success' => true,
        'message' => $resultado['message'],
        'data' => $resultado['data']
    ], 200);
}

    public function getByCantidadDisponible(int $cantidad_disponible)
    {
        $inventarios = $this->inventarioService
            ->getByCantidadDisponible($cantidad_disponible);

        return response()->json([
            'success' => 'Inventarios filtrados por cantidad disponible correctamente',
            'data' => $inventarios
        ], 200);
    }

    public function getByCantidadMinima(int $cantidad_minima)
    {
        $inventarios = $this->inventarioService
            ->getByCantidadMinima($cantidad_minima);

        return response()->json([
            'success' => 'Inventarios filtrados por cantidad mínima correctamente',
            'data' => $inventarios
        ], 200);
    }

    public function getByProducto(int $id_producto)
    {
        $inventarios = $this->inventarioService
            ->getByProducto($id_producto);

        return response()->json([
            'success' => 'Inventarios filtrados por producto correctamente',
            'data' => $inventarios
        ], 200);
    }
}