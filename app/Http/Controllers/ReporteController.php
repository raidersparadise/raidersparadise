<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reporte\StoreReporteRequest;
use App\Http\Requests\Reporte\UpdateReporteRequest;
use App\Services\ReporteService;

class ReporteController extends Controller
{
    protected ReporteService $reporteService;

    public function __construct(ReporteService $reporteService)
    {
        $this->reporteService = $reporteService;
    }

    public function index()
    {
        return response()->json([
            'success' => 'Reportes consultados correctamente',
            'data' => $this->reporteService->getAll()
        ]);
    }

    public function show(int $id)
    {
        return response()->json([
            'success' => 'Reporte encontrado correctamente',
            'data' => $this->reporteService->getById($id)
        ]);
    }

    public function store(StoreReporteRequest $request)
    {
        $data = $request->validated();

        return response()->json([
            'success' => 'Reporte creado correctamente',
            'data' => $this->reporteService->create($data)
        ], 201);
    }

    public function update(UpdateReporteRequest $request, int $id)
    {
        $data = $request->validated();

        return response()->json([
            'success' => 'Reporte actualizado correctamente',
            'data' => $this->reporteService->update($data, $id)
        ]);
    }

    public function destroy(int $id)
    {
        $resultado = $this->reporteService->delete($id);

        return $this->respuestaEliminacion(
            $resultado,
            'Reporte'
        );
    }

    public function getByUsuario(int $id_usuario)
    {
        return response()->json([
            'success' => 'Reportes filtrados por usuario correctamente',
            'data' => $this->reporteService->getByUsuario($id_usuario)
        ]);
    }

    public function getByTipoReporte(string $tipo_reporte)
    {
        return response()->json([
            'success' => 'Reportes filtrados por tipo correctamente',
            'data' => $this->reporteService->getByTipoReporte($tipo_reporte)
        ]);
    }

    public function getByFechaGeneracion(string $fecha_generacion)
    {
        return response()->json([
            'success' => 'Reportes filtrados por fecha correctamente',
            'data' => $this->reporteService->getByFechaGeneracion($fecha_generacion)
        ]);
    }
}