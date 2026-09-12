<?php

namespace App\Http\Requests\Categoria;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_categoria' => 'required|string|max:40',
            'descripcion_categoria' => 'nullable|string|max:255',
        ];
    }
}