<?php

namespace App\Http\Requests\Detalle_carrito;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetalle_CarritoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_carrito' => 'sometimes|integer|exists:carrito,id_carrito',
            'id_producto' => 'sometimes|integer|exists:producto,id_producto',
            'cantidad' => 'sometimes|integer|min:1',
            'precio_unitario' => 'sometimes|numeric|min:0',
            'subtotal' => 'sometimes|numeric|min:0',
        ];
    }
}
