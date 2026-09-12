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
}