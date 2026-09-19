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

            'nombre_producto' => 'required|string|max:40|unique:producto,nombre_producto',

            'descripcion_producto' => 'nullable|string|max:255',

            'precio_producto' => 'required|numeric|min:0',

            'estado_producto' => 'required|string|max:50',

            'imagen_producto' => 'nullable|string|max:255',

            'comentario_producto' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'id_categoria.required' => 'El ID de la categoría es obligatorio.',
            'id_categoria.integer' => 'El ID de la categoría debe ser un número entero.',
            'id_categoria.exists' => 'La categoría seleccionada no existe.',

            'id_marca.required' => 'El ID de la marca es obligatorio.',
            'id_marca.integer' => 'El ID de la marca debe ser un número entero.',
            'id_marca.exists' => 'La marca seleccionada no existe.',

            'id_proveedor.required' => 'El ID del proveedor es obligatorio.',
            'id_proveedor.integer' => 'El ID del proveedor debe ser un número entero.',
            'id_proveedor.exists' => 'El proveedor seleccionado no existe.',

            'nombre_producto.required' => 'El nombre del producto es obligatorio.',
            'nombre_producto.string' => 'El nombre del producto debe ser una cadena de texto.',
            'nombre_producto.max' => 'El nombre del producto no debe exceder los 40 caracteres.',
            'nombre_producto.unique' => 'El nombre del producto ya está registrado en la base de datos.',

            'descripcion_producto.string' => 'La descripción del producto debe ser una cadena de texto.',
            'descripcion_producto.max' => 'La descripción del producto no debe exceder los 255 caracteres.',

            'precio_producto.required' => 'El precio del producto es obligatorio.',
            'precio_producto.numeric' => 'El precio del producto debe ser un número.',
            'precio_producto.min' => 'El precio del producto no puede ser negativo.',

            'estado_producto.required' => 'El estado del producto es obligatorio.',
            'estado_producto.string' => 'El estado del producto debe ser una cadena de texto.',
            'estado_producto.max' => 'El estado del producto no debe exceder los 50 caracteres.',

            'imagen_producto.string' => 'La imagen del producto debe ser una cadena de texto.',
            'imagen_producto.max' => 'La imagen del producto no debe exceder los 255 caracteres.',

            'comentario_producto.string' => 'El comentario del producto debe ser una cadena de texto.',
            'comentario_producto.max' => 'El comentario del producto no debe exceder los 255 caracteres.',
        ];
    }
}