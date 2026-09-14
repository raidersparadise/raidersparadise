<?php

namespace App\Services;

use App\Models\Reporte;

class ReporteService
{
    public function getAll()
    {
        return Reporte::all();
    }

    public function getById(int $id)
    {
        return Reporte::findOrFail($id);
    }

    public function create(array $data)
    {
        return Reporte::create($data);
    }

    public function update(array $data, int $id)
    {
        $reporte = Reporte::findOrFail($id);

        $reporte->update($data);

        return $reporte;
    }

    public function delete(int $id)
    {
        $reporte = Reporte::findOrFail($id);

        return $reporte->delete();
    }
}