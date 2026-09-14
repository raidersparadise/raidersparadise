<?php

namespace App\Http\Requests\Inventario;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cantidad_disponible' => 'required|integer|min:0',
            'cantidad_minima' => 'required|integer|min:0',
            'id_producto' => 'required|integer|exists:producto,id_producto',
        ];
    }
}