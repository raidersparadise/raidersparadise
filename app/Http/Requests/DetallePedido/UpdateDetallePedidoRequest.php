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


    public function messages(): array
    {
        return [
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',

            'precio_unitario.numeric' => 'El precio unitario debe ser un número.',
            'precio_unitario.min' => 'El precio unitario no puede ser negativo.',

            'sub_total.numeric' => 'El sub total debe ser un número.',
            'sub_total.min' => 'El sub total no puede ser negativo.',

            'id_pedido.integer' => 'El ID del pedido debe ser un número entero.',
            'id_pedido.exists' => 'El pedido seleccionado no existe.',

            'id_producto.integer' => 'El ID del producto debe ser un número entero.',
            'id_producto.exists' => 'El producto seleccionado no existe.',
        ];
    }
}