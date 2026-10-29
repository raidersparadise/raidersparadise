<?php

namespace App\Http\Controllers;

use App\Models\DetalleCarrito;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    private function cliente(Request $request)
    {
        return $request->user()->clienteAsociado();
    }

    public function index(Request $request)
    {
        $carrito = $this->cliente($request)->carritoActivo()->load('detalles.producto.inventario', 'detalles.producto.marca');

        return view('tienda.carrito', compact('carrito'));
    }

    public function agregar(Request $request, Producto $producto)
    {
        $datos = $request->validate(['cantidad' => ['nullable', 'integer', 'min:1', 'max:20']]);
        $cantidad = (int) ($datos['cantidad'] ?? 1);

        if (! $producto->disponible) {
            return back()->with('error', 'Este producto no está disponible en este momento.');
        }

        $carrito = $this->cliente($request)->carritoActivo();
        $detalle = $carrito->detalles()->firstOrNew(['id_producto' => $producto->id_producto]);
        $nueva = ($detalle->exists ? $detalle->cantidad : 0) + $cantidad;

        if ($nueva > $producto->stock) {
            return back()->with('error', "Solo hay {$producto->stock} unidades disponibles de {$producto->nombre_producto}.");
        }

        $detalle->fill([
            'cantidad' => $nueva,
            'precio_unitario' => $producto->precio_producto,
            'subtotal' => $nueva * $producto->precio_producto,
        ])->save();

        return back()->with('ok', "Agregaste {$producto->nombre_producto} al carrito.");
    }

    public function actualizar(Request $request, DetalleCarrito $detalle)
    {
        $this->autorizar($request, $detalle);
        $datos = $request->validate(['cantidad' => ['required', 'integer', 'min:1', 'max:20']]);
        $stock = $detalle->producto->stock;

        if ($datos['cantidad'] > $stock) {
            return back()->with('error', "Solo hay {$stock} unidades disponibles.");
        }

        $detalle->update([
            'cantidad' => $datos['cantidad'],
            'precio_unitario' => $detalle->producto->precio_producto,
            'subtotal' => $datos['cantidad'] * $detalle->producto->precio_producto,
        ]);

        return back()->with('ok', 'Cantidad actualizada.');
    }

    public function eliminar(Request $request, DetalleCarrito $detalle)
    {
        $this->autorizar($request, $detalle);
        $detalle->delete();

        return back()->with('ok', 'Producto retirado del carrito.');
    }

    private function autorizar(Request $request, DetalleCarrito $detalle): void
    {
        abort_unless($detalle->carrito->id_cliente === $request->user()->cliente?->id_cliente, 403);
    }
}
