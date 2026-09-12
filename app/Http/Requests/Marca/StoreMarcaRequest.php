<?php

namespace App\Http\Requests\Marca;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarcaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_marca' => 'required|string|max:40',
            'descripcion_marca' => 'nullable|string|max:255',
        ];
    }
}