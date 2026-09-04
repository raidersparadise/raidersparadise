<?php

namespace App\Services;

use App\Interfaces\ReporteInterface;

class ReporteService
{
    protected ReporteInterface $reporteRepository;

    public function __construct(ReporteInterface $reporteRepository)
    {
        $this->reporteRepository = $reporteRepository;
    }

    public function getAll()
    {
        return $this->reporteRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->reporteRepository->getById($id);
    }

    public function create(array $data)
    {
        return $this->reporteRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->reporteRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->reporteRepository->delete($id);
    }

    public function getByUsuario(int $id_usuario)
    {
        return $this->reporteRepository->getByUsuario($id_usuario);
    }

    public function getByTipoReporte(string $tipo_reporte)
    {
        return $this->reporteRepository->getByTipoReporte($tipo_reporte);
    }

    public function getByFechaGeneracion(string $fecha_generacion)
    {
        return $this->reporteRepository->getByFechaGeneracion($fecha_generacion);
    }
}