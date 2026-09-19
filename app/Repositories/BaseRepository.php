<?php

namespace App\Repositories;

use App\Interfaces\BaseInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $datos)
    {
        return $this->model->create($datos);
    }

    public function update(array $datos, int $id)
    {
        $registro = $this->model->find($id);

        if (!$registro) {
            return null;
        }

        $registro->update($datos);

        return $registro->fresh();
    }

    public function delete(int $id)
    {
        /*
         * Buscamos también los registros eliminados
         * para poder saber si el ID existió anteriormente.
         */
        $registro = $this->model
            ->withTrashed()
            ->find($id);

        /*
         * Si nunca existió el registro
         */
        if (!$registro) {
            return [
                'status' => 'not_found',
                'message' => 'Dato no encontrado',
                'data' => null
            ];
        }

        /*
         * Si ya estaba eliminado mediante SoftDelete,
         * para el CRUD se considera que ya no existe.
         */
        if ($registro->trashed()) {
            return [
                'status' => 'not_found',
                'message' => 'Dato no encontrado',
                'data' => null
            ];
        }

        /*
         * Primera eliminación:
         * SoftDelete actualiza deleted_at.
         */
        $registro->delete();

        return [
            'status' => 'deleted',
            'message' => 'Dato eliminado correctamente',
            'data' => $registro
        ];
    }
}