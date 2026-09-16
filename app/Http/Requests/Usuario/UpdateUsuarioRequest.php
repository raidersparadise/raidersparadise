<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_rol' => 'sometimes|integer|exists:rol,id_rol',

            'nombre_usuario' => 'sometimes|string|max:40',

            'apellido_usuario' => 'sometimes|string|max:40',

            'email' => [
                'sometimes',
                'email',
                'max:100',
                Rule::unique('usuario', 'email')
                    ->ignore(
                        $this->route('usuario'),
                        'id_usuario'
                    ),
            ],

            'password' => 'sometimes|string|min:8|max:60',
        ];
    }
}