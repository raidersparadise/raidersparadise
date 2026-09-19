<?php

namespace App\Http\Controllers;

use App\Services\FacturaService;
use App\Http\Requests\Factura\StoreFacturaRequest;
use App\Http\Requests\Factura\UpdateFacturaRequest;

class FacturaController extends Controller
{
    protected $facturaService;

    public function __construct(FacturaService $facturaService)
    {
        $this->facturaService = $facturaService;
    }

    /**
     * Listar todas las facturas.
     */
    public function index()
    {
        $facturas = $this->facturaService->getAll();

        return response()->json([
            'success' => 'Facturas consultadas correctamente',
            'data' => $facturas
        ], 200);
    }

    /**
     * Crear una nueva factura.
     */
    public function store(StoreFacturaRequest $datos)
    {
        $factura = $this->facturaService->create(
            $datos->validated()
        );

        return response()->json([
            'success' => 'Factura creada correctamente',
            'datosInsertado' => $factura
        ], 201);
    }

    /**
     * Consultar una factura por ID.
     */
    public function show(int $id)
    {
        $factura = $this->facturaService->getById($id);

        return response()->json([
            'success' => 'Factura encontrada correctamente',
            'data' => $factura
        ], 200);
    }

    /**
     * Actualizar una factura.
     */
    public function update(UpdateFacturaRequest $datosActualizar, int $id)
    {
        $factura = $this->facturaService->update(
            $datosActualizar->validated(),
            $id
        );

        return response()->json([
            'success' => 'Factura actualizada correctamente',
            'data' => $factura
        ], 200);
    }

    /**
     * Eliminar una factura.
     */
    public function destroy(int $id)
{
    $resultado = $this->facturaService->delete($id);

    return $this->respuestaEliminacion(
        $resultado,
        'Factura'
    );
}
}