<?php

namespace App\Http\Requests\DetallePedido;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetallePedidoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'sub_total' => 'required|numeric|min:0',
            'id_pedido' => 'required|integer|exists:pedido,id_pedido',
            'id_producto' => 'required|integer|exists:producto,id_producto',
        ];
    }
}