<?php

namespace App\Http\Requests\Marca;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarcaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_marca' => 'sometimes|string|max:40',
            'descripcion_marca' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_marca.string' => 'El nombre de la marca debe ser una cadena de texto.',
            'nombre_marca.max' => 'El nombre de la marca no debe exceder los 40 caracteres.',

            'descripcion_marca.string' => 'La descripción de la marca debe ser una cadena de texto.',
            'descripcion_marca.max' => 'La descripción de la marca no debe exceder los 255 caracteres.',
        ];
    }
}