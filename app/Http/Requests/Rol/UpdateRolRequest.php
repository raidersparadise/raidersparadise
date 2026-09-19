<?php

namespace App\Http\Requests\Rol;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_rol' => 'sometimes|string|max:40',
            'descripcion' => 'sometimes|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_rol.string' => 'El nombre del rol debe ser una cadena de texto.',
            'nombre_rol.max' => 'El nombre del rol no debe exceder los 40 caracteres.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
        ];
    }

}