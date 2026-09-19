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

    public function messages(): array
    {
        return [
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',

            'precio_unitario.required' => 'El precio unitario es obligatorio.',
            'precio_unitario.numeric' => 'El precio unitario debe ser un número.',
            'precio_unitario.min' => 'El precio unitario no puede ser negativo.',

            'sub_total.required' => 'El sub total es obligatorio.',
            'sub_total.numeric' => 'El sub total debe ser un número.',
            'sub_total.min' => 'El sub total no puede ser negativo.',

            'id_pedido.required' => 'El ID del pedido es obligatorio.',
            'id_pedido.integer' => 'El ID del pedido debe ser un número entero.',
            'id_pedido.exists' => 'El pedido seleccionado no existe.',

            'id_producto.required' => 'El ID del producto es obligatorio.',
            'id_producto.integer' => 'El ID del producto debe ser un número entero.',
            'id_producto.exists' => 'El producto seleccionado no existe.',
        ];
    }
}