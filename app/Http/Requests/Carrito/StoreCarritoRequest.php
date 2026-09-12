<?php

namespace App\Http\Requests\Carrito;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarritoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_cliente' => 'required|integer|exists:cliente,id_cliente',
            'fecha_agregado' => 'required|date',
        ];
    }
}