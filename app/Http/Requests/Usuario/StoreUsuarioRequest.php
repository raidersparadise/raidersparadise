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
            'nombre_usuario' => 'required|string|max:100',
            'apellido_usuario' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:usuario,email',
            'password' => 'required|string|min:8|max:255',
        ];
    }
}