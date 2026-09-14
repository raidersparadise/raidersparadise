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
        return response()->json(
            $this->reporteService->getAll()
        );
    }

    public function show(int $id)
    {
        return response()->json(
            $this->reporteService->getById($id)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_usuario' => 'required|integer',
            'tipo_reporte' => 'required|string|max:100',
            'fecha_generacion' => 'required|date',
        ]);

        return response()->json(
            $this->reporteService->create($data),
            201
        );
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'id_usuario' => 'sometimes|integer',
            'tipo_reporte' => 'sometimes|string|max:100',
            'fecha_generacion' => 'sometimes|date',
        ]);

        return response()->json(
            $this->reporteService->update($id, $data)
        );
    }

    public function destroy(int $id)
    {
        $this->reporteService->delete($id);

        return response()->json([
            'message' => 'Reporte eliminado correctamente'
        ]);
    }

    public function getByUsuario(int $id_usuario)
    {
        return response()->json(
            $this->reporteService->getByUsuario($id_usuario)
        );
    }

    public function getByTipoReporte(string $tipo_reporte)
    {
        return response()->json(
            $this->reporteService->getByTipoReporte($tipo_reporte)
        );
    }

    public function getByFechaGeneracion(string $fecha_generacion)
    {
        return response()->json(
            $this->reporteService->getByFechaGeneracion($fecha_generacion)
        );
    }
}