<?php

namespace App\Interfaces;

interface ReporteInterface extends BaseInterface
{
    public function getByUsuario(int $id_usuario);

    public function getByTipoReporte(string $tipo_reporte);

    public function getByFechaGeneracion(string $fecha_generacion);
}