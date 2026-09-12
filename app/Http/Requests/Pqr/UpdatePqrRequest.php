<?php

namespace App\Http\Requests\Pqr;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePqrRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_usuario' => 'sometimes|integer|exists:usuario,id_usuario',
            'id_cliente' => 'sometimes|integer|exists:cliente,id_cliente',
            'descripcion_pqr' => 'sometimes|string|max:255',
            'estado' => 'sometimes|in:recibida,asignada,en proceso,requerido,cerrada,rechazada',
            'fecha' => 'sometimes|date',
        ];
    }
}