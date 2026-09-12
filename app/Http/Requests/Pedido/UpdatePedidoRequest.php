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
}
