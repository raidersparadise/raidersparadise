<?php

namespace App\Http\Controllers;

use App\Services\InventarioService;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    protected InventarioService $inventarioService;

    public function __construct(InventarioService $inventarioService)
    {
        $this->inventarioService = $inventarioService;
    }

    public function index()
    {
        return response()->json(
            $this->inventarioService->getAll()
        );
    }

    public function show(int $id)
    {
        return response()->json(
            $this->inventarioService->getById($id)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cantidad_disponible' => 'required|integer|min:0',
            'cantidad_minima' => 'required|integer|min:0',
            'id_producto' => 'required|integer',
        ]);

        return response()->json(
            $this->inventarioService->create($data),
            201
        );
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'cantidad_disponible' => 'sometimes|integer|min:0',
            'cantidad_minima' => 'sometimes|integer|min:0',
            'id_producto' => 'sometimes|integer',
        ]);

        return response()->json(
            $this->inventarioService->update($id, $data)
        );
    }

    public function destroy(int $id)
    {
        $this->inventarioService->delete($id);

        return response()->json([
            'message' => 'Inventario eliminado correctamente'
        ]);
    }

    public function getByCantidadDisponible(int $cantidad_disponible)
    {
        return response()->json(
            $this->inventarioService->getByCantidadDisponible($cantidad_disponible)
        );
    }

    public function getByCantidadMinima(int $cantidad_minima)
    {
        return response()->json(
            $this->inventarioService->getByCantidadMinima($cantidad_minima)
        );
    }

    public function getByProducto(int $id_producto)
    {
        return response()->json(
            $this->inventarioService->getByProducto($id_producto)
        );
    }
}