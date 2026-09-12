<?php

namespace App\Http\Requests\Factura;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFacturaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha_factura' => 'sometimes|date',
            'total_factura' => 'sometimes|numeric|min:0',
            'impuesto' => 'sometimes|numeric|min:0',
            'estado_factura' => 'sometimes|string|max:50',
            'pago' => 'sometimes|numeric|min:0',
            'metodo_pago' => 'sometimes|string|max:50',
            'id_pedido' => 'sometimes|integer|exists:pedido,id_pedido',
        ];
    }
}