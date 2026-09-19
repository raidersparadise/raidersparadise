<?php

namespace App\Http\Controllers;

use App\Services\DetalleCarritoService;
use App\Http\Requests\Detalle_carrito\StoreDetalle_carritoRequest;
use App\Http\Requests\Detalle_carrito\UpdateDetalle_carritoRequest;

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
    public function store(StoreDetalle_carritoRequest $request)
    {
        $data = $request->validated();

        $detalle = $this->detalleCarritoService->create($data);

        return response()->json([
            'mensaje' => 'Detalle del carrito creado correctamente',
            'datos' => $detalle
        ], 201);
    }

    // Actualizar
    public function update(UpdateDetalle_carritoRequest $request, int $id)
    {
        $data = $request->validated();

        $resultado = $this->detalleCarritoService->update($data, $id);

        if ($resultado === null) {
            return response()->json([
                'message' => 'Detalle del carrito no encontrado'
            ], 404);
        }

        if ($resultado['ya_actualizado'] === true) {
            return response()->json([
                'message' => 'El detalle del carrito ya se encuentra actualizado',
                'data' => $resultado['detalle']
            ]);
        }

        return response()->json([
            'message' => 'Detalle del carrito actualizado correctamente',
            'data' => $resultado['detalle']
        ]);
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