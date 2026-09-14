<?php

namespace App\Http\Requests\Producto;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_categoria' => 'required|integer|exists:categoria,id_categoria',
            'id_marca' => 'required|integer|exists:marca,id_marca',
            'id_proveedor' => 'required|integer|exists:proveedor,id_proveedor',
            'nombre_producto' => 'required|string|max:150',
            'descripcion_producto' => 'required|string|max:500',
            'precio_producto' => 'required|numeric|min:0',
            'estado_producto' => 'required|string|max:50',
            'imagen_producto' => 'nullable|string|max:255',
            'comentario_producto' => 'nullable|string|max:500',
        ];
    }
}