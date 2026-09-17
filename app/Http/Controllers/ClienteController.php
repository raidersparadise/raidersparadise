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

    // Obtener todos los clientes
    public function index()
    {
        $clientes = $this->clienteService->getAll();

        return response()->json([
            'success' => 'Clientes obtenidos correctamente',
            'datos' => $clientes
        ], 200);
    }

    // Obtener cliente por ID
    public function show(int $id)
    {
        $cliente = $this->clienteService->getById($id);

        return response()->json([
            'success' => 'Cliente obtenido correctamente',
            'datos' => $cliente
        ], 200);
    }

    // Crear cliente
    public function store(StoreClienteRequest $request)
    {
        $cliente = $this->clienteService->create(
            $request->validated()
        );

        return response()->json([
            'success' => 'Cliente creado correctamente',
            'datos' => $cliente
        ], 201);
    }

    // Actualizar cliente
    public function update(UpdateClienteRequest $request, int $id)
    {
        $cliente = $this->clienteService->update(
            $request->validated(),
            $id
        );

        return response()->json([
            'success' => 'Cliente actualizado correctamente',
            'datos' => $cliente
        ], 200);
    }

    // Eliminar cliente
    public function destroy(int $id)
    {
        $this->clienteService->delete($id);

        return response()->json([
            'mensaje' => 'Cliente eliminado correctamente'
        ], 200);
    }

    // Buscar clientes por nombre
    public function getByName(string $nombre)
    {
        $clientes = $this->clienteService->getByName($nombre);

        return response()->json([
            'success' => 'Clientes filtrados por nombre correctamente',
            'datos' => $clientes
        ], 200);
    }

    // Buscar clientes por apellido
    public function getByLastname(string $apellido)
    {
        $clientes = $this->clienteService->getByLastname($apellido);

        return response()->json([
            'success' => 'Clientes filtrados por apellido correctamente',
            'datos' => $clientes
        ], 200);
    }
}