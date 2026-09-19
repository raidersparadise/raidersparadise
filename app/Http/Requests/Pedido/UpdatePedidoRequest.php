<?php

namespace App\Http\Requests\Pedido;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha' => 'sometimes|date',
            'estado' => 'sometimes|in:programado,en_curso,Entregado,cancelado',
            'total' => 'sometimes|numeric|min:0',
            'id_cliente' => 'sometimes|integer|exists:cliente,id_cliente',
        ];
    }

    public function messages(): array
    {
        return [
            'fecha.date' => 'La fecha del pedido debe ser una fecha válida.',

            'estado.in' => 'El estado del pedido debe ser uno de los siguientes: programado, en_curso, Entregado, cancelado.',

            'total.numeric' => 'El total del pedido debe ser un número.',
            'total.min' => 'El total del pedido no puede ser negativo.',

            'id_cliente.integer' => 'El ID del cliente debe ser un número entero.',
            'id_cliente.exists' => 'El cliente seleccionado no existe.',
        ];
    }
}
