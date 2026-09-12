<?php

namespace App\Http\Requests\Pqr;

use Illuminate\Foundation\Http\FormRequest;

class StorePqrRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_usuario' => 'required|integer|exists:usuario,id_usuario',
            'id_cliente' => 'required|integer|exists:cliente,id_cliente',
            'descripcion_pqr' => 'required|string|max:255',
            'estado' => 'required|in:recibida,asignada,en proceso,requerido,cerrada,rechazada',
            'fecha' => 'required|date',
        ];
    }
}