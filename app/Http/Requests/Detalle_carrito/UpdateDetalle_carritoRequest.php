<?php

namespace App\Http\Requests\DetalleCarrito;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetalleCarritoRequest extends FormRequest
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


    public function messages(): array
    {
        return [
            'id_carrito.integer' => 'El ID del carrito debe ser un número entero.',
            'id_carrito.exists' => 'El carrito seleccionado no existe.',

            'id_producto.integer' => 'El ID del producto debe ser un número entero.',
            'id_producto.exists' => 'El producto seleccionado no existe.',

            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',

            'precio_unitario.numeric' => 'El precio unitario debe ser un número.',
            'precio_unitario.min' => 'El precio unitario no puede ser negativo.',

            'subtotal.numeric' => 'El subtotal debe ser un número.',
            'subtotal.min' => 'El subtotal no puede ser negativo.',
        ];
    }
}
