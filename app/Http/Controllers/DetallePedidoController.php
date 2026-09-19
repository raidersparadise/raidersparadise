<?php

namespace App\Http\Controllers;

//comentarios

use App\Services\DetallePedidoService;
use App\Http\Requests\DetallePedido\StoreDetallePedidoRequest;
use App\Http\Requests\DetallePedido\UpdateDetallePedidoRequest;

class DetallePedidoController extends Controller
{
    protected $detallePedidoService;

    public function __construct(DetallePedidoService $detallePedidoService)
    {
        $this->detallePedidoService = $detallePedidoService;
    }

    public function index()
    {
        $detalles = $this->detallePedidoService->getAll();

        return response()->json([
            'success' => 'Detalles de pedidos consultados correctamente',
            'data' => $detalles
        ], 200);
    }

    public function store(StoreDetallePedidoRequest $datos)
    {
        $detalle = $this->detallePedidoService->create(
            $datos->validated()
        );

        return response()->json([
            'success' => 'Detalle de pedido creado correctamente',
            'datosInsertado' => $detalle
        ], 201);
    }

    public function show(int $id)
    {
        $detalle = $this->detallePedidoService->getById($id);

        return response()->json([
            'success' => 'Detalle de pedido encontrado correctamente',
            'data' => $detalle
        ], 200);
    }

    public function update(
        UpdateDetallePedidoRequest $datosActualizar,
        int $id
    ) {
        $detalle = $this->detallePedidoService->update(
            $datosActualizar->validated(),
            $id
        );

        return response()->json([
            'success' => 'Detalle de pedido actualizado correctamente',
            'data' => $detalle
        ], 200);
    }

    public function destroy(int $id)
{
    $resultado = $this->detallePedidoService->delete($id);

    return $this->respuestaEliminacion(
        $resultado,
        'Detalle del pedido'
    );
}   

    public function porCantidad(int $cantidad)
    {
        $detalles = $this->detallePedidoService->getByCantidad($cantidad);

        return response()->json([
            'success' => 'Detalles consultados por cantidad correctamente',
            'data' => $detalles
        ], 200);
    }

    public function porPrecioUnitario(float $precio_unitario)
    {
        $detalles = $this->detallePedidoService->getByPrecioUnitario($precio_unitario);

        return response()->json([
            'success' => 'Detalles consultados por precio unitario correctamente',
            'data' => $detalles
        ], 200);
    }

    public function porSubTotal(float $sub_total)
    {
        $detalles = $this->detallePedidoService->getBySubTotal($sub_total);

        return response()->json([
            'success' => 'Detalles consultados por subtotal correctamente',
            'data' => $detalles
        ], 200);
    }

    public function porPedido(int $id_pedido)
    {
        $detalles = $this->detallePedidoService->getByPedido($id_pedido);

        return response()->json([
            'success' => 'Detalles consultados por pedido correctamente',
            'data' => $detalles
        ], 200);
    }

    public function porProducto(int $id_producto)
    {
        $detalles = $this->detallePedidoService->getByProducto($id_producto);

        return response()->json([
            'success' => 'Detalles consultados por producto correctamente',
            'data' => $detalles
        ], 200);
    }
}