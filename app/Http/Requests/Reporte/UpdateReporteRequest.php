<?php

namespace App\Http\Requests\Reporte;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReporteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_usuario' => 'sometimes|integer|exists:usuario,id_usuario',
            'tipo_reporte' => 'sometimes|string|max:100',
            'fecha_generacion' => 'sometimes|date',
        ];
    }
}