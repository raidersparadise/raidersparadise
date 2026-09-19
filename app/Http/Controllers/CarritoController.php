<?php

namespace App\Http\Controllers;

use App\Services\CarritoService;
use App\Http\Requests\Carrito\StoreCarritoRequest;
use App\Http\Requests\Carrito\UpdateCarritoRequest;

class CarritoController extends Controller
{
    protected $carritoService;

    public function __construct(CarritoService $carritoService)
    {
        $this->carritoService = $carritoService;
    }

    public function index()
    {
        $carritos = $this->carritoService->getAll();

        return response()->json([
            'success' => 'Carritos consultados correctamente',
            'data' => $carritos
        ], 200);
    }

    public function store(StoreCarritoRequest $datos)
    {
        $carrito = $this->carritoService->create(
            $datos->validated()
        );

        return response()->json([
            'success' => 'Carrito creado correctamente',
            'datosInsertado' => $carrito
        ], 201);
    }

    public function show(int $id)
    {
        $carrito = $this->carritoService->getById($id);

        return response()->json([
            'success' => 'Carrito encontrado correctamente',
            'data' => $carrito
        ], 200);
    }

    public function update(UpdateCarritoRequest $datosActualizar, int $id)
    {
        $carrito = $this->carritoService->update(
            $datosActualizar->validated(),
            $id
        );

        return response()->json([
            'success' => 'Carrito actualizado correctamente',
            'data' => $carrito
        ], 200);
    }

    public function destroy($id)
{
    $resultado = $this->carritoService->delete($id);

    if ($resultado['status'] === 'deleted') {
        return response()->json([
            'success' => true,
            'message' => 'Dato eliminado correctamente'
        ], 200);
    }

    if ($resultado['status'] === 'already_deleted') {
        return response()->json([
            'success' => false,
            'message' => 'Dato eliminado'
        ], 410);
    }

    return response()->json([
        'success' => false,
        'message' => 'Dato no encontrado'
    ], 404);
}

    public function getByCliente(int $id_cliente)
    {
        $carritos = $this->carritoService->getByCliente($id_cliente);

        return response()->json([
            'success' => 'Carritos del cliente obtenidos correctamente',
            'data' => $carritos
        ], 200);
    }
}