<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_cliente' => 'sometimes|string|max:40',
            'apellido_cliente' => 'sometimes|string|max:40',
            'email' => [
                'sometimes',
                'email',
                'max:150',
                Rule::unique('cliente', 'email')
                    ->ignore($this->route('id'), 'id_cliente'),
            ],
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:100',
        ];
    }
}