<?php

namespace App\Http\Controllers;

use App\Services\ClienteService;
use App\Http\Requests\Cliente\StoreClienteRequest;
use App\Http\Requests\Cliente\UpdateClienteRequest;

class ClienteController extends Controller
{
    protected $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function index()
    {
        $clientes = $this->clienteService->getAll();

        return response()->json([
            'success' => 'Clientes consultados correctamente',
            'data' => $clientes
        ], 200);
    }

    public function store(StoreClienteRequest $datos)
    {
        $cliente = $this->clienteService->create(
            $datos->validated()
        );

        return response()->json([
            'success' => 'Cliente creado correctamente',
            'datosInsertado' => $cliente
        ], 201);
    }

    public function show(int $id)
    {
        $cliente = $this->clienteService->getById($id);

        return response()->json([
            'success' => 'Cliente encontrado correctamente',
            'data' => $cliente
        ], 200);
    }

    public function update(UpdateClienteRequest $datosActualizar, int $id)
    {
        $cliente = $this->clienteService->update(
            $datosActualizar->validated(),
            $id
        );

        return response()->json([
            'success' => 'Cliente actualizado correctamente',
            'data' => $cliente
        ], 200);
    }

    public function destroy(int $id)
    {
        $this->clienteService->delete($id);

        return response()->json([
            'success' => 'Cliente eliminado correctamente'
        ], 200);
    }
}
