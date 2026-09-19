<?php

namespace App\Http\Requests\Inventario;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cantidad_disponible' => 'sometimes|integer|min:0',
            'cantidad_minima' => 'sometimes|integer|min:0',
            'id_producto' => 'sometimes|integer|exists:producto,id_producto',
        ];
    }

    public function messages(): array
    {
        return [
            'cantidad_disponible.integer' => 'La cantidad disponible debe ser un número entero.',
            'cantidad_disponible.min' => 'La cantidad disponible no puede ser negativa.',

            'cantidad_minima.integer' => 'La cantidad mínima debe ser un número entero.',
            'cantidad_minima.min' => 'La cantidad mínima no puede ser negativa.',

            'id_producto.integer' => 'El ID del producto debe ser un número entero.',
            'id_producto.exists' => 'El producto seleccionado no existe.',
        ];
    }
}