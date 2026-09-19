<?php

namespace App\Http\Requests\Proveedor;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_proveedor' => 'required|string|max:40',

            'telefono_proveedor' => [
                'required',
                'string',
                'max:20',
                'unique:proveedor,telefono_proveedor',
            ],

            'direccion_proveedor' => 'nullable|string|max:100',

            'email_proveedor' => [
                'nullable',
                'email',
                'max:100',
                'unique:proveedor,email_proveedor',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_proveedor.required' => 'El nombre del proveedor es obligatorio.',
            'nombre_proveedor.string' => 'El nombre del proveedor debe ser una cadena de texto.',
            'nombre_proveedor.max' => 'El nombre del proveedor no debe exceder los 40 caracteres.',

            'telefono_proveedor.required' => 'El teléfono del proveedor es obligatorio.',
            'telefono_proveedor.string' => 'El teléfono del proveedor debe ser una cadena de texto.',
            'telefono_proveedor.max' => 'El teléfono del proveedor no debe exceder los 20 caracteres.',
            'telefono_proveedor.unique' => 'El teléfono del proveedor ya está registrado en la base de datos.',

            'direccion_proveedor.string' => 'La dirección del proveedor debe ser una cadena de texto.',
            'direccion_proveedor.max' => 'La dirección del proveedor no debe exceder los 100 caracteres.',

            'email_proveedor.email' => 'El correo electrónico del proveedor debe ser una dirección de correo válida.',
            'email_proveedor.max' => 'El correo electrónico del proveedor no debe exceder los 100 caracteres.',
            'email_proveedor.unique' => 'El correo electrónico del proveedor ya está registrado en la base de datos.',
        ];
    }
}