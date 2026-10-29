<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CuentaController extends Controller
{
    public function pedidos(Request $request)
    {
        $pedidos = Pedido::with('factura')
            ->where('id_cliente', $request->user()->cliente?->id_cliente)
            ->latest('fecha')->paginate(10);

        return view('cuenta.pedidos', compact('pedidos'));
    }

    public function pedido(Request $request, Pedido $pedido)
    {
        $this->autorizar($request, $pedido);
        $pedido->load('detalles.producto', 'factura', 'cliente');

        return view('cuenta.pedido', compact('pedido'));
    }

    public function factura(Request $request, Pedido $pedido)
    {
        if (! $request->user()->esPersonal()) {
            $this->autorizar($request, $pedido);
        }
        $pedido->load('detalles.producto', 'factura', 'cliente');
        abort_unless($pedido->factura, 404);

        return view('cuenta.factura', compact('pedido'));
    }

    public function perfil(Request $request)
    {
        $usuario = $request->user()->load('cliente');

        return view('cuenta.perfil', compact('usuario'));
    }

    public function actualizarPerfil(Request $request)
    {
        $usuario = $request->user();
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:40'],
            'apellido' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:100', Rule::unique('usuario', 'email')->ignore($usuario->id_usuario, 'id_usuario')],
            'telefono' => ['nullable', 'string', 'max:20'],
            'documento' => ['nullable', 'string', 'max:20'],
            'direccion' => ['nullable', 'string', 'max:100'],
            'ciudad' => ['nullable', 'string', 'max:60'],
            'password' => ['nullable', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        $usuario->fill([
            'nombre_usuario' => $datos['nombre'],
            'apellido_usuario' => $datos['apellido'],
            'email' => $datos['email'],
            'telefono' => $datos['telefono'],
        ]);
        if (! empty($datos['password'])) {
            $usuario->password = $datos['password'];
        }
        $usuario->save();

        if ($usuario->cliente) {
            $usuario->cliente->update([
                'nombre_cliente' => $datos['nombre'],
                'apellido_cliente' => $datos['apellido'],
                'email' => $datos['email'],
                'telefono' => $datos['telefono'],
                'documento' => $datos['documento'],
                'direccion' => $datos['direccion'],
                'ciudad' => $datos['ciudad'],
            ]);
        }

        return back()->with('ok', 'Tus datos fueron actualizados.');
    }

    public function pqrs(Request $request)
    {
        $pqrs = $request->user()->cliente?->pqrs()->latest('fecha')->get() ?? collect();

        return view('cuenta.pqrs', compact('pqrs'));
    }

    private function autorizar(Request $request, Pedido $pedido): void
    {
        abort_unless($pedido->id_cliente === $request->user()->cliente?->id_cliente, 403);
    }
}
