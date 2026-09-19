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
        $registro = $this->model->find($id);

        if ($registro) {
            $registro->delete();

            return [
                'status' => 'deleted',
                'message' => 'Dato eliminado correctamente'
            ];
        }
        
        if (method_exists($this->model, 'trashed')) {
            $registroEliminado = $this->model
                ->withTrashed()
                ->find($id);

            if ($registroEliminado) {
                return [
                    'status' => 'already_deleted',
                    'message' => 'Dato eliminado'
                ];
            }
        }

        return [
            'status' => 'not_found',
            'message' => 'Dato no encontrado'
        ];
    }
}