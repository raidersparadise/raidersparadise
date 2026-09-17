<?php

namespace App\Services;

use App\Interfaces\ReporteInterface;

class ReporteService implements ReporteInterface
{
    public function __construct(
        private ReporteInterface $reporteRepository
    ) {}

    public function getAll()
    {
        return $this->reporteRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->reporteRepository->getById($id);
    }

    public function create(array $datos)
    {
        return $this->reporteRepository->create($datos);
    }

    public function update(array $datos, int $id)
    {
        return $this->reporteRepository->update($datos, $id);
    }

    public function delete(int $id)
    {
        return $this->reporteRepository->delete($id);
    }

    public function getByUsuario(int $id_usuario)
    {
        return $this->reporteRepository
            ->getByUsuario($id_usuario);
    }

    public function getByTipoReporte(string $tipo_reporte)
    {
        return $this->reporteRepository
            ->getByTipoReporte($tipo_reporte);
    }

    public function getByFechaGeneracion(string $fecha_generacion)
    {
        return $this->reporteRepository
            ->getByFechaGeneracion($fecha_generacion);
    }
}