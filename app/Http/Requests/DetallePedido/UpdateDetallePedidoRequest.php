<?php

namespace App\Http\Requests\DetallePedido;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetallePedidoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cantidad' => 'sometimes|integer|min:1',
            'precio_unitario' => 'sometimes|numeric|min:0',
            'sub_total' => 'sometimes|numeric|min:0',
            'id_pedido' => 'sometimes|integer|exists:pedido,id_pedido',
            'id_producto' => 'sometimes|integer|exists:producto,id_producto',
        ];
    }
}