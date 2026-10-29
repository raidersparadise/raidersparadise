<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $clientes = Cliente::withCount('pedidos')
            ->withSum(['pedidos as total_comprado' => fn ($p) => $p->where('estado', '!=', 'cancelado')], 'total')
            ->when($q, fn ($w) => $w->where(fn ($x) => $x->where('nombre_cliente', 'like', "%{$q}%")->orWhere('apellido_cliente', 'like', "%{$q}%")->orWhere('email', 'like', "%{$q}%")->orWhere('documento', 'like', "%{$q}%")))
            ->orderByDesc('total_comprado')
            ->paginate(15)->withQueryString();

        return view('admin.clientes.index', compact('clientes'));
    }

    public function show(Cliente $cliente)
    {
        $cliente->load(['pedidos' => fn ($q) => $q->latest('fecha'), 'pqrs', 'usuario']);

        return view('admin.clientes.show', compact('cliente'));
    }
}
