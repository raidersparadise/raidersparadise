<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

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
            'nombre_usuario' => 'sometimes|string|max:100',
            'apellido_usuario' => 'sometimes|string|max:100',
            'email' => 'sometimes|email|max:150|unique:usuario,email,' . $this->route('id') . ',id_usuario',
            'password' => 'sometimes|string|min:8|max:255',
        ];
    }
}