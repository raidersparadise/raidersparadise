<?php

namespace App\Http\Controllers;

use App\Services\DetalleCarritoService;
use Illuminate\Http\Request;

class DetalleCarritoController extends Controller
{
    private $detalleCarritoService;

    public function __construct(DetalleCarritoService $detalleCarritoService)
    {
        $this->detalleCarritoService = $detalleCarritoService;
    }

    public function index()
    {
        return response()->json([
        'mensaje' => 'Detalles del carrito obtenidos correctamente',
        'datos' => $this->detalleCarritoService->getAll()
        ], 200);
    }
    public function getAll()
    {
        return DetalleCarrito::with(['carrito', 'producto'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->all();

        return response()->json(
            $this->detalleCarritoService->create($data)
        );
    }

    public function show($id)
    {
        return response()->json(
            $this->detalleCarritoService->show($id)
        );
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        return response()->json(
            $this->detalleCarritoService->update($data, $id)
        );
    }

    public function destroy($id)
    {
        return response()->json(
            $this->detalleCarritoService->delete($id)
        );
    }
}