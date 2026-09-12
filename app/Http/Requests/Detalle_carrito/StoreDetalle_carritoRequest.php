<?php

namespace App\Http\Requests\Detalle_carrito;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetalle_carritoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_carrito' => 'required|integer|exists:carrito,id_carrito',
            'id_producto' => 'required|integer|exists:producto,id_producto',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ];
    }
}
