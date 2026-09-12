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
            'email' => 'required|email|max:150|unique:cliente,email',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:100',
        ];
    }
}