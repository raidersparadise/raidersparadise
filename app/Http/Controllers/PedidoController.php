<?php

namespace App\Http\Controllers;

use App\Services\PedidoService;
use App\Http\Requests\Pedido\StorePedidoRequest;
use App\Http\Requests\Pedido\UpdatePedidoRequest;

class PedidoController extends Controller
{
    protected $pedidoService;

    public function __construct(PedidoService $pedidoService)
    {
        $this->pedidoService = $pedidoService;
    }

    public function index()
    {
        $pedidos = $this->pedidoService->getAll();

        return response()->json([
            'success' => 'Pedidos consultados correctamente',
            'data' => $pedidos
        ], 200);
    }

    public function store(StorePedidoRequest $datos)
    {
        $pedido = $this->pedidoService->create(
            $datos->validated()
        );

        return response()->json([
            'success' => 'Pedido creado correctamente',
            'datosInsertado' => $pedido
        ], 201);
    }

    public function show(int $id)
    {
        $pedido = $this->pedidoService->getById($id);

        return response()->json([
            'success' => 'Pedido encontrado correctamente',
            'data' => $pedido
        ], 200);
    }

    public function update(UpdatePedidoRequest $datosActualizar, int $id)
    {
        $pedido = $this->pedidoService->update(
            $datosActualizar->validated(),
            $id
        );

        return response()->json([
            'success' => 'Pedido actualizado correctamente',
            'data' => $pedido
        ], 200);
    }

    public function destroy(int $id)
    {
        $this->pedidoService->delete($id);

        return response()->json([
            'success' => 'Pedido eliminado correctamente'
        ], 200);
    }

    public function getByEstado(string $estado)
    {
        $pedidos = $this->pedidoService->getByEstado($estado);

        return response()->json([
            'success' => 'Pedidos filtrados por estado correctamente',
            'data' => $pedidos
        ], 200);
    }

    public function getByFecha(string $fecha)
    {
        $pedidos = $this->pedidoService->getByFecha($fecha);

        return response()->json([
            'success' => 'Pedidos filtrados por fecha correctamente',
            'data' => $pedidos
        ], 200);
    }

    public function getByTotal(float $total)
    {
        $pedidos = $this->pedidoService->getByTotal($total);

        return response()->json([
            'success' => 'Pedidos filtrados por total correctamente',
            'data' => $pedidos
        ], 200);
    }

    public function getByCliente(int $id_cliente)
    {
        $pedidos = $this->pedidoService->getByCliente($id_cliente);

        return response()->json([
            'success' => 'Pedidos del cliente obtenidos correctamente',
            'data' => $pedidos
        ], 200);
    }
}