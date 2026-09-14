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
            'id_rol' => 'required|exists:rol,id_rol',
            'nombre_usuario' => 'required|string|max:100',
            'apellido_usuario' => 'required|string|max:100',
            'email_cliente' => 'required|email|max:150|unique:usuario,email_cliente',
            'password' => 'required|string|min:8|max:255',
        ];
    }
}