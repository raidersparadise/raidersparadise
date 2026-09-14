<?php

namespace App\Http\Requests\Proveedor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_proveedor' => 'sometimes|string|max:150',
            'telefono_proveedor' => 'sometimes|string|max:20',
            'direccion_proveedor' => 'sometimes|string|max:255',
            'email_proveedor' => 'sometimes|email|max:150|unique:proveedor,email_proveedor,' . $this->route('id') . ',id_proveedor',
        ];
    }
}