<?php

namespace App\Http\Requests\Pedido;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha' => 'required|date',
            'estado' => 'required|in:programado,en_curso,Entregado,cancelado',
            'total' => 'required|numeric|min:0',
            'id_cliente' => 'required|integer|exists:cliente,id_cliente',
        ];
    }

    public function messages(): array
    {
        return [
            'fecha.required' => 'La fecha del pedido es obligatoria.',
            'fecha.date' => 'La fecha del pedido debe ser una fecha válida.',

            'estado.required' => 'El estado del pedido es obligatorio.',
            'estado.in' => 'El estado del pedido debe ser uno de los siguientes: programado, en_curso, Entregado, cancelado.',

            'total.required' => 'El total del pedido es obligatorio.',
            'total.numeric' => 'El total del pedido debe ser un número.',
            'total.min' => 'El total del pedido no puede ser negativo.',

            'id_cliente.required' => 'El ID del cliente es obligatorio.',
            'id_cliente.integer' => 'El ID del cliente debe ser un número entero.',
            'id_cliente.exists' => 'El cliente seleccionado no existe.',
        ];
    }
}