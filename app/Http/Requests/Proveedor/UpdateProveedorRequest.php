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
}