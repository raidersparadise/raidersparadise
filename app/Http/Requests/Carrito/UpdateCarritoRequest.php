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
}