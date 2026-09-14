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
}