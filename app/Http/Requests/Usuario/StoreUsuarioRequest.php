<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_rol' => 'required|integer|exists:rol,id_rol',
            'nombre_usuario' => 'required|string|max:40',
            'apellido_usuario' => 'required|string|max:40',
            'email' => 'required|email|max:100|unique:usuario,email',
            'password' => 'required|string|min:8|max:60',
        ];
    }
}