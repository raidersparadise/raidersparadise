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
}