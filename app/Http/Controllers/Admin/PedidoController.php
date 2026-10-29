<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Services\PedidoService;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $pedidos = Pedido::with('cliente', 'factura')
            ->when($request->query('estado'), fn ($w, $e) => $w->where('estado', $e))
            ->when($request->query('q'), function ($w, $q) {
                $id = (int) preg_replace('/\D/', '', $q);
                $w->where(fn ($x) => $x->where('id_pedido', $id)
                    ->orWhereHas('cliente', fn ($c) => $c->where('nombre_cliente', 'like', "%{$q}%")->orWhere('apellido_cliente', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%")));
            })
            ->latest('fecha')->paginate(15)->withQueryString();

        $conteo = Pedido::selectRaw('estado, COUNT(*) as n')->groupBy('estado')->pluck('n', 'estado');

        return view('admin.pedidos.index', compact('pedidos', 'conteo'));
    }

    public function show(Pedido $pedido)
    {
        $pedido->load('cliente', 'detalles.producto', 'factura');

        return view('admin.pedidos.show', compact('pedido'));
    }

    public function update(Request $request, Pedido $pedido, PedidoService $servicio)
    {
        $datos = $request->validate(['estado' => ['required', 'in:'.implode(',', array_keys(Pedido::ESTADOS))]]);
        $servicio->cambiarEstado($pedido->load('detalles', 'factura'), $datos['estado']);

        return back()->with('ok', "Pedido {$pedido->codigo} actualizado a «{$pedido->fresh()->estado_texto}».");
    }
}
