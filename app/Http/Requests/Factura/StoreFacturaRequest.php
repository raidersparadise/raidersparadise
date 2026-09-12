<?php

namespace App\Http\Requests\Factura;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacturaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha_factura' => 'required|date',
            'total_factura' => 'required|numeric|min:0',
            'impuesto' => 'required|numeric|min:0',
            'estado_factura' => 'required|string|max:50',
            'pago' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|max:50',
            'id_pedido' => 'required|integer|exists:pedido,id_pedido',
        ];
    }
}