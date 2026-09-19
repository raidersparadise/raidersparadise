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

    // Obtener todos
    public function index()
    {
        $detalles = $this->detalleCarritoService->getAll();

        return response()->json([
            'mensaje' => 'Detalles del carrito obtenidos correctamente',
            'datos' => $detalles
        ], 200);
    }

    // Obtener por ID
    public function show(int $id)
    {
        $detalle = $this->detalleCarritoService->getById($id);

        return response()->json([
            'mensaje' => 'Detalle del carrito encontrado correctamente',
            'datos' => $detalle
        ], 200);
    }

    // Crear
    public function store(Request $request)
    {
        $data = $request->all();

        $detalle = $this->detalleCarritoService->create($data);

        return response()->json([
            'mensaje' => 'Detalle del carrito creado correctamente',
            'datos' => $detalle
        ], 201);
    }

    // Actualizar
    public function update(Request $request, int $id)
    {
        $data = $request->all();

        $detalle = $this->detalleCarritoService->update($data, $id);

        return response()->json([
            'mensaje' => 'Detalle del carrito actualizado correctamente',
            'datos' => $detalle
        ], 200);
    }

    // Eliminar
    public function destroy(int $id)
{
    $resultado = $this->detalleCarritoService->delete($id);

    return $this->respuestaEliminacion(
        $resultado,
        'Detalle del carrito'
    );
}

    // Buscar por carrito
    public function getByCarrito(int $id_carrito)
    {
        $detalles = $this->detalleCarritoService->getByCarrito($id_carrito);

        return response()->json([
            'mensaje' => 'Detalles del carrito obtenidos correctamente',
            'datos' => $detalles
        ], 200);
    }

    // Buscar por producto
    public function getByProducto(int $id_producto)
    {
        $detalles = $this->detalleCarritoService->getByProducto($id_producto);

        return response()->json([
            'mensaje' => 'Detalles del producto obtenidos correctamente',
            'datos' => $detalles
        ], 200);
    }
}