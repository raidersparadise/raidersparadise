<?php

namespace App\Repositories;

use App\Interfaces\ReporteInterface;
use App\Models\Reporte;

class ReporteRepository extends BaseRepository implements ReporteInterface
{
    public function __construct(Reporte $reporte)
    {
        parent::__construct($reporte);
    }

    public function getAll()
    {
        return $this->model
            ->with('usuario')
            ->get();
    }

    public function getById(int $id)
    {
        return $this->model
            ->with('usuario')
            ->find($id);
    }

    public function create(array $datos)
    {
        return $this->model
            ->create($datos)
            ->load('usuario');
    }

    public function update(array $datos, int $id)
    {
        $reporte = $this->model->find($id);

        if (!$reporte) {
            return null;
        }

        $reporte->update($datos);

        return $reporte
            ->fresh()
            ->load('usuario');
    }

    public function getByUsuario(int $id_usuario)
    {
        return $this->model
            ->with('usuario')
            ->where('id_usuario', $id_usuario)
            ->get();
    }

    public function getByTipoReporte(string $tipo_reporte)
    {
        return $this->model
            ->with('usuario')
            ->where(
                'tipo_reporte',
                'LIKE',
                '%' . $tipo_reporte . '%'
            )
            ->get();
    }

    public function getByFechaGeneracion(string $fecha_generacion)
    {
        return $this->model
            ->with('usuario')
            ->whereDate(
                'fecha_generacion',
                $fecha_generacion
            )
            ->get();
    }
}