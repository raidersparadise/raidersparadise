<?php

namespace App\Http\Requests\Pqr;

use Illuminate\Foundation\Http\FormRequest;

class StorePqrRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_usuario' => 'required|integer|exists:usuario,id_usuario',
            'id_cliente' => 'required|integer|exists:cliente,id_cliente',
            'descripcion_pqr' => 'required|string|max:255',
            'estado' => 'required|in:recibida,asignada,en proceso,requerido,cerrada,rechazada',
            'fecha' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'id_usuario.required' => 'El ID del usuario es obligatorio.',
            'id_usuario.integer' => 'El ID del usuario debe ser un número entero.',
            'id_usuario.exists' => 'El usuario seleccionado no existe.',

            'id_cliente.required' => 'El ID del cliente es obligatorio.',
            'id_cliente.integer' => 'El ID del cliente debe ser un número entero.',
            'id_cliente.exists' => 'El cliente seleccionado no existe.',

            'descripcion_pqr.required' => 'La descripción de la PQR es obligatoria.',
            'descripcion_pqr.string' => 'La descripción de la PQR debe ser una cadena de texto.',
            'descripcion_pqr.max' => 'La descripción de la PQR no debe exceder los 255 caracteres.',

            'estado.required' => 'El estado de la PQR es obligatorio.',
            'estado.in' => 'El estado de la PQR debe ser uno de los siguientes: recibida, asignada, en proceso, requerido, cerrada, rechazada.',

            'fecha.required' => 'La fecha de la PQR es obligatoria.',
            'fecha.date' => 'La fecha de la PQR debe ser una fecha válida.',
        ];
    }
}