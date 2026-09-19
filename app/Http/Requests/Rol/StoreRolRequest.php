<?php

namespace App\Http\Requests\Rol;

use Illuminate\Foundation\Http\FormRequest;

class StoreRolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_rol' => 'required|string|max:40|unique:rol,nombre_rol',
            'descripcion' => 'required|string',
        ];
    }
    
    public function messages(): array
    {
        return [
            'nombre_rol.required' => 'El nombre del rol es obligatorio.',
            'nombre_rol.string' => 'El nombre del rol debe ser texto.',
            'nombre_rol.max' => 'El nombre del rol no debe exceder los 40 caracteres.',
            'nombre_rol.unique' => 'El rol ya está creado o existe.',
            'descripcion.required' => 'La descripción del rol es obligatoria.',
            'descripcion.string' => 'La descripción del rol debe ser texto.',
            
        ];
    }


}