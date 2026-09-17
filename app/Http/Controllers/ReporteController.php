<?php

namespace App\Http\Controllers;

use App\Services\ReporteService;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_usuario' => 'required|integer',
            'tipo_reporte' => 'required|string|max:100',
            'fecha_generacion' => 'required|date',
        ]);

        return response()->json([
            'success' => 'Reporte creado correctamente',
            'data' => $this->reporteService->create($data)
        ], 201);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'id_usuario' => 'sometimes|integer',
            'tipo_reporte' => 'sometimes|string|max:100',
            'fecha_generacion' => 'sometimes|date',
        ]);

        return response()->json([
            'success' => 'Reporte actualizado correctamente',
            'data' => $this->reporteService->update($data, $id)
        ]);
    }

    public function destroy(int $id)
    {
        $this->reporteService->delete($id);

        return response()->json([
            'success' => 'Reporte eliminado correctamente',
        ]);
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