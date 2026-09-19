<?php

namespace App\Http\Requests\Categoria;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_categoria' => 'sometimes|string|max:40',
            'descripcion_categoria' => 'sometimes|nullable|string|max:255',
        ];
    }


    public function messages(): array
    {
        return [
            'nombre_categoria.string' => 'El nombre de la categoría debe ser una cadena de texto.',
            'nombre_categoria.max' => 'El nombre de la categoría no debe exceder los 40 caracteres.',

            'descripcion_categoria.string' => 'La descripción de la categoría debe ser una cadena de texto.',
            'descripcion_categoria.max' => 'La descripción de la categoría no debe exceder los 255 caracteres.',
        ];
    }
}