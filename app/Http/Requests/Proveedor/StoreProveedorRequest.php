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
}