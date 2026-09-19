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

    public function messages(): array
    {
        return [
            'id_rol.required' => 'El ID del rol es obligatorio.',
            'id_rol.integer' => 'El ID del rol debe ser un número entero.',
            'id_rol.exists' => 'El ID del rol no existe en la base de datos.',
            'nombre_usuario.required' => 'El nombre del usuario es obligatorio.',
            'nombre_usuario.string' => 'El nombre del usuario debe ser una cadena de texto.',
            'nombre_usuario.max' => 'El nombre del usuario no debe exceder los 40 caracteres.',
            'apellido_usuario.required' => 'El apellido del usuario es obligatorio.',
            'apellido_usuario.string' => 'El apellido del usuario debe ser una cadena de texto.',
            'apellido_usuario.max' => 'El apellido del usuario no debe exceder los 40 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El correo electrónico no debe exceder los 100 caracteres.',
            'email.unique' => 'El correo electrónico ya está registrado en la base de datos.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña no debe exceder los 60 caracteres.',
        ];
    }
}