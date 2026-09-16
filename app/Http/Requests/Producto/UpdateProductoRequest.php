<?php

namespace App\Http\Requests\Producto;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_categoria' => 'sometimes|integer|exists:categoria,id_categoria',

            'id_marca' => 'sometimes|integer|exists:marca,id_marca',

            'id_proveedor' => 'sometimes|integer|exists:proveedor,id_proveedor',

            'nombre_producto' => 'sometimes|string|max:40',

            'descripcion_producto' => 'sometimes|nullable|string|max:255',

            'precio_producto' => 'sometimes|numeric|min:0',

            'estado_producto' => 'sometimes|string|max:50',

            'imagen_producto' => 'sometimes|nullable|string|max:255',

            'comentario_producto' => 'sometimes|nullable|string|max:255',
        ];
    }
}