<?php

namespace App\Http\Controllers;

use App\Services\ClienteService;
use Illuminate\Http\Requests;
use App\Http\Requests\Cliente\StoreClienteRequest;

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
        return response()->json([
            'mensaje' => 'Clientes obtenidos correctamente',
            'datos' => $this->clienteService->getAll()
        ], 200);
    }

    // Obtener cliente por ID
    public function show(int $id)
    {
        return response()->json([
            'mensaje' => 'Cliente obtenido correctamente',
            'datos' => $this->clienteService->getById($id)
        ], 200);
    }

    // Crear cliente
    public function store(StoreClienteRequest $request)
    {
        $datos = $request->validate([
            'nombre_cliente' => 'required|string|max:40',
            'apellido_cliente' => 'required|string|max:40',
            'email_cliente' => 'required|email|max:150|unique:cliente,email_cliente',
            'telefono_cliente' => 'nullable|string|max:20',
            'direccion_cliente' => 'nullable|string|max:100',
        ]);

        return response()->json([
            'mensaje' => 'Cliente creado correctamente',
            'datos' => $this->clienteService->create($request->validated())
        ], 201);
    }

    // Actualizar cliente
    public function update(Request $request, int $id)
    {
        $datos = $request->validate([
            'nombre_cliente' => 'sometimes|string|max:40',
            'apellido_cliente' => 'sometimes|string|max:40',
            'email_cliente' => 'sometimes|email|max:150|unique:cliente,email_cliente,' . $id . ',id_cliente',
            'telefono_cliente' => 'sometimes|nullable|string|max:20',
            'direccion_cliente' => 'sometimes|nullable|string|max:100',
        ]);

        return response()->json([
            'mensaje' => 'Cliente actualizado correctamente',
            'datos' => $this->clienteService->update($datos, $id)
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
        return response()->json([
            'mensaje' => 'Clientes filtrados por nombre correctamente',
            'datos' => $this->clienteService->getByName($nombre)
        ], 200);
    }

    // Buscar clientes por apellido
    public function getByLastname(string $apellido)
    {
        return response()->json([
            'mensaje' => 'Clientes filtrados por apellido correctamente',
            'datos' => $this->clienteService->getByLastname($apellido)
        ], 200);
    }
}