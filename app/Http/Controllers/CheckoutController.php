<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Services\PedidoService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $cliente = $request->user()->cliente;
        $carrito = $cliente?->carritoActivo()->load('detalles.producto');

        if (! $carrito || $carrito->detalles->isEmpty()) {
            return redirect()->route('carrito')->with('error', 'Tu carrito está vacío.');
        }

        $metodos = Factura::METODOS_PAGO;

        return view('tienda.checkout', compact('cliente', 'carrito', 'metodos'));
    }

    public function store(Request $request, PedidoService $servicio)
    {
        $datos = $request->validate([
            'direccion_envio' => ['required', 'string', 'max:150'],
            'ciudad_envio' => ['required', 'string', 'max:60'],
            'telefono' => ['required', 'string', 'max:20'],
            'notas' => ['nullable', 'string', 'max:255'],
            'metodo_pago' => ['required', 'in:'.implode(',', array_keys(Factura::METODOS_PAGO))],
        ], [], ['direccion_envio' => 'dirección', 'ciudad_envio' => 'ciudad', 'metodo_pago' => 'medio de pago']);

        $pedido = $servicio->crearDesdeCarrito($request->user()->cliente, $datos);

        return redirect()->route('cuenta.pedido', $pedido)->with('ok', "¡Pedido {$pedido->codigo} confirmado! Te avisaremos cuando salga a ruta.");
    }
}
