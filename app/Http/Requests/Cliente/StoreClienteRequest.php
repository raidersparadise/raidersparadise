<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_cliente' => 'required|string|max:40',
            'apellido_cliente' => 'required|string|max:40',
            'email_cliente' => 'required|email|unique:cliente,email_cliente',
            'telefono_cliente' => 'nullable|string|max:20',
            'direccion_cliente' => 'nullable|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_cliente.required' => 'El nombre del cliente es obligatorio.',
            'nombre_cliente.string' => 'El nombre del cliente debe ser una cadena de texto.',
            'nombre_cliente.max' => 'El nombre del cliente no debe exceder los 40 caracteres.',

            'apellido_cliente.required' => 'El apellido del cliente es obligatorio.',
            'apellido_cliente.string' => 'El apellido del cliente debe ser una cadena de texto.',
            'apellido_cliente.max' => 'El apellido del cliente no debe exceder los 40 caracteres.',

            'email_cliente.required' => 'El correo electrónico del cliente es obligatorio.',
            'email_cliente.email' => 'El correo electrónico del cliente debe ser una dirección de correo válida.',
            'email_cliente.unique' => 'El correo electrónico del cliente ya está registrado en la base de datos.',

            'telefono_cliente.string' => 'El teléfono del cliente debe ser una cadena de texto.',
            'telefono_cliente.max' => 'El teléfono del cliente no debe exceder los 20 caracteres.',

            'direccion_cliente.string' => 'La dirección del cliente debe ser una cadena de texto.',
            'direccion_cliente.max' => 'La dirección del cliente no debe exceder los 100 caracteres.',
        ];
    }
}