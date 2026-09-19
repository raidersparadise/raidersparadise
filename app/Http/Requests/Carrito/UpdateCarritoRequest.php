<?php

namespace App\Http\Requests\Carrito;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarritoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_cliente' => 'sometimes|integer|exists:cliente,id_cliente',
            'fecha_agregado' => 'sometimes|date',
        ];
    }

    public function messages(): array
    {
        return [
            'id_cliente.integer' => 'El ID del cliente debe ser un número entero.',
            'id_cliente.exists' => 'El cliente seleccionado no existe.',

            'fecha_agregado.date' => 'La fecha de agregado debe ser una fecha válida.',
        ];
    }
}