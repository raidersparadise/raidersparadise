<?php

namespace App\Http\Requests\Proveedor;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_proveedor' => 'required|string|max:150',
            'telefono_proveedor' => 'required|string|max:20',
            'direccion_proveedor' => 'required|string|max:255',
            'email_proveedor' => 'required|email|max:150|unique:proveedor,email_proveedor',
        ];
    }
}