<?php

namespace App\Http\Requests\Marca;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarcaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_marca' => 'sometimes|string|max:40',
            'descripcion_marca' => 'nullable|string|max:255',
        ];
    }
}