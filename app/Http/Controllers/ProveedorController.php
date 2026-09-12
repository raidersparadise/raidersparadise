<?php

namespace App\Http\Controllers;

use App\Services\ProveedorService;
use App\Http\Requests\Proveedor\StoreProveedorRequest;
use App\Http\Requests\Proveedor\UpdateProveedorRequest;

class ProveedorController extends Controller
{
    protected $proveedorService;

    public function __construct(ProveedorService $proveedorService)
    {
        $this->proveedorService = $proveedorService;
    }

    /**
     * Listar todos los proveedores.
     */
    public function index()
    {
        $proveedores = $this->proveedorService->getAll();

        return response()->json([
            'success' => 'Proveedores consultados correctamente',
            'data' => $proveedores
        ], 200);
    }

    /**
     * Crear un nuevo proveedor.
     */
    public function store(StoreProveedorRequest $datos)
    {
        $proveedor = $this->proveedorService->create(
            $datos->validated()
        );

        return response()->json([
            'success' => 'Proveedor creado correctamente',
            'datosInsertado' => $proveedor
        ], 201);
    }

    /**
     * Consultar un proveedor por ID.
     */
    public function show(int $id)
    {
        $proveedor = $this->proveedorService->getById($id);

        return response()->json([
            'success' => 'Proveedor encontrado correctamente',
            'data' => $proveedor
        ], 200);
    }

    /**
     * Actualizar un proveedor.
     */
    public function update(UpdateProveedorRequest $datosActualizar, int $id)
    {
        $proveedor = $this->proveedorService->update(
            $datosActualizar->validated(),
            $id
        );

        return response()->json([
            'success' => 'Proveedor actualizado correctamente',
            'data' => $proveedor
        ], 200);
    }

    /**
     * Eliminar un proveedor.
     */
    public function destroy(int $id)
    {
        $this->proveedorService->delete($id);

        return response()->json([
            'success' => 'Proveedor eliminado correctamente'
        ], 200);
    }

    /**
     * Buscar proveedores por nombre.
     */
    public function getByNombreProveedor(string $nombre_proveedor)
    {
        $proveedores = $this->proveedorService
            ->getByNombreProveedor($nombre_proveedor);

        return response()->json([
            'success' => 'Proveedores filtrados por nombre correctamente',
            'data' => $proveedores
        ], 200);
    }

    /**
     * Buscar proveedores por teléfono.
     */
    public function getByTelefonoProveedor(string $telefono_proveedor)
    {
        $proveedores = $this->proveedorService
            ->getByTelefonoProveedor($telefono_proveedor);

        return response()->json([
            'success' => 'Proveedores filtrados por teléfono correctamente',
            'data' => $proveedores
        ], 200);
    }

    /**
     * Buscar proveedores por dirección.
     */
    public function getByDireccionProveedor(string $direccion_proveedor)
    {
        $proveedores = $this->proveedorService
            ->getByDireccionProveedor($direccion_proveedor);

        return response()->json([
            'success' => 'Proveedores filtrados por dirección correctamente',
            'data' => $proveedores
        ], 200);
    }

    /**
     * Buscar proveedores por email.
     */
    public function getByEmailProveedor(string $email_proveedor)
    {
        $proveedores = $this->proveedorService
            ->getByEmailProveedor($email_proveedor);

        return response()->json([
            'success' => 'Proveedores filtrados por email correctamente',
            'data' => $proveedores
        ], 200);
    }
}