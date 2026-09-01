<?php

namespace App\Interfaces;

interface BaseInterface
{
    public function getAll(); // Traer todos los registros

    public function getById(int $id); // Obtener por ID

    public function create(array $datos); // Crear registro

    public function update(array $datos, int $id); // Actualizar registro

    public function delete(int $id); // Eliminar registro
}