<?php

namespace App\Http\Requests\Proveedor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_proveedor' => 'sometimes|string|max:40',

            'telefono_proveedor' => 'sometimes|string|max:20',

            'direccion_proveedor' => 'sometimes|nullable|string|max:100',

            'email_proveedor' => [
                'sometimes',
                'nullable',
                'email',
                'max:100',
                Rule::unique('proveedor', 'email_proveedor')
                    ->ignore(
                        $this->route('proveedor'),
                        'id_proveedor'
                    ),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_proveedor.string' => 'El nombre del proveedor debe ser una cadena de texto.',
            'nombre_proveedor.max' => 'El nombre del proveedor no debe exceder los 40 caracteres.',

            'telefono_proveedor.string' => 'El teléfono del proveedor debe ser una cadena de texto.',
            'telefono_proveedor.max' => 'El teléfono del proveedor no debe exceder los 20 caracteres.',

            'direccion_proveedor.string' => 'La dirección del proveedor debe ser una cadena de texto.',
            'direccion_proveedor.max' => 'La dirección del proveedor no debe exceder los 100 caracteres.',

            'email_proveedor.email' => 'El correo electrónico del proveedor debe ser una dirección de correo válida.',
            'email_proveedor.max' => 'El correo electrónico del proveedor no debe exceder los 100 caracteres.',
            'email_proveedor.unique' => 'El correo electrónico del proveedor ya está registrado en la base de datos.',
        ];
    }
}