<?php

namespace App\Http\Controllers;

use App\Services\DetalleCarritoService;
use App\Http\Requests\Detalle_carrito\StoreDetalleCarritoRequest;
use App\Http\Requests\Detalle_carrito\UpdateDetalleCarritoRequest;

class Detalle_carritoController extends Controller
{
    protected $detalleCarritoService;

    public function __construct(DetalleCarritoService $detalleCarritoService)
    {
        $this->detalleCarritoService = $detalleCarritoService;
    }

    public function index()
    {
        $detalles = $this->detalleCarritoService->getAll();

        return response()->json([
            'success' => 'Detalles de carrito consultados correctamente',
            'data' => $detalles
        ], 200);
    }

    public function store(StoreDetalleCarritoRequest $datos)
    {
        $detalle = $this->detalleCarritoService->create(
            $datos->validated()
        );

        return response()->json([
            'success' => 'Detalle de carrito creado correctamente',
            'datosInsertado' => $detalle
        ], 201);
    }

    public function show(int $id)
    {
        $detalle = $this->detalleCarritoService->getById($id);

        return response()->json([
            'success' => 'Detalle de carrito encontrado correctamente',
            'data' => $detalle
        ], 200);
    }

    public function update(UpdateDetalleCarritoRequest $datosActualizar, int $id)
    {
        $detalle = $this->detalleCarritoService->update(
            $datosActualizar->validated(),
            $id
        );

        return response()->json([
            'success' => 'Detalle de carrito actualizado correctamente',
            'data' => $detalle
        ], 200);
    }

    public function destroy(int $id)
    {
        $this->detalleCarritoService->delete($id);

        return response()->json([
            'success' => 'Detalle de carrito eliminado correctamente'
        ], 200);
    }
}