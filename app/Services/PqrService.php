<?php

namespace App\Services;

use App\Models\Pqr;

class PqrService
{
    public function getAll()
    {
        return Pqr::all();
    }

    public function getById(int $id)
    {
        return Pqr::findOrFail($id);
    }

    public function create(array $data)
    {
        return Pqr::create($data);
    }

    public function update(array $data, int $id)
    {
        $pqr = Pqr::findOrFail($id);

        $pqr->update($data);

        return $pqr;
    }

    public function delete(int $id)
    {
        $pqr = Pqr::findOrFail($id);

        return $pqr->delete();
    }
}