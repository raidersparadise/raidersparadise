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

    public function messages(): array
    {
        return [
            'id_usuario.integer' => 'El ID del usuario debe ser un número entero.',
            'id_usuario.exists' => 'El ID del usuario no existe en la base de datos.',
            'tipo_reporte.string' => 'El tipo de reporte debe ser una cadena de texto.',
            'tipo_reporte.max' => 'El tipo de reporte no debe exceder los 100 caracteres.',
            'fecha_generacion.date' => 'La fecha de generación debe ser una fecha válida.',
        ];
    }
}