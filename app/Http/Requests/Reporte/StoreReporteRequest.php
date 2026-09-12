<?php

namespace App\Http\Requests\Reporte;

use Illuminate\Foundation\Http\FormRequest;

class StoreReporteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_usuario' => 'required|integer|exists:usuario,id_usuario',
            'tipo_reporte' => 'required|string|max:100',
            'fecha_generacion' => 'required|date',
        ];
    }
}