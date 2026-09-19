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

    public function messages(): array
    {
        return [
            'fecha_factura.required' => 'La fecha de la factura es obligatoria.',
            'fecha_factura.date' => 'La fecha de la factura debe ser una fecha válida.',

            'total_factura.required' => 'El total de la factura es obligatorio.',
            'total_factura.numeric' => 'El total de la factura debe ser un número.',
            'total_factura.min' => 'El total de la factura no puede ser negativo.',

            'impuesto.required' => 'El impuesto es obligatorio.',
            'impuesto.numeric' => 'El impuesto debe ser un número.',
            'impuesto.min' => 'El impuesto no puede ser negativo.',

            'estado_factura.required' => 'El estado de la factura es obligatorio.',
            'estado_factura.string' => 'El estado de la factura debe ser una cadena de texto.',
            'estado_factura.max' => 'El estado de la factura no debe exceder los 50 caracteres.',

            'pago.required' => 'El pago es obligatorio.',
            'pago.numeric' => 'El pago debe ser un número.',
            'pago.min' => 'El pago no puede ser negativo.',

            'metodo_pago.required' => 'El método de pago es obligatorio.',
            'metodo_pago.string' => 'El método de pago debe ser una cadena de texto.',
            'metodo_pago.max' => 'El método de pago no debe exceder los 50 caracteres.',

            'id_pedido.required' => 'El ID del pedido es obligatorio.',
            'id_pedido.integer' => 'El ID del pedido debe ser un número entero.',
            'id_pedido.exists' => 'El pedido seleccionado no existe.',
        ];
    }
}