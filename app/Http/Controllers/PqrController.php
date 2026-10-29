<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pqr;
use Illuminate\Http\Request;

class PqrController extends Controller
{
    public function create(Request $request)
    {
        $usuario = $request->user();

        return view('tienda.pqr', ['usuario' => $usuario, 'tipos' => Pqr::TIPOS]);
    }

    public function store(Request $request)
    {
        $usuario = $request->user();
        $reglas = [
            'tipo' => ['required', 'in:'.implode(',', array_keys(Pqr::TIPOS))],
            'asunto' => ['required', 'string', 'max:120'],
            'descripcion' => ['required', 'string', 'min:10', 'max:1000'],
        ];
        if (! $usuario) {
            $reglas += [
                'nombre' => ['required', 'string', 'max:40'],
                'apellido' => ['required', 'string', 'max:40'],
                'email' => ['required', 'email', 'max:150'],
                'telefono' => ['nullable', 'string', 'max:20'],
                'terminos' => ['accepted'],
            ];
        }
        $datos = $request->validate($reglas, ['terminos.accepted' => 'Debes autorizar el tratamiento de datos.'], ['descripcion' => 'descripción']);

        if ($usuario) {
            $cliente = $usuario->clienteAsociado();
        } else {
            $cliente = Cliente::firstOrCreate(['email' => $datos['email']], [
                'nombre_cliente' => $datos['nombre'],
                'apellido_cliente' => $datos['apellido'],
                'telefono' => $datos['telefono'] ?? null,
            ]);
        }

        $pqr = Pqr::create([
            'id_cliente' => $cliente->id_cliente,
            'tipo' => $datos['tipo'],
            'asunto' => $datos['asunto'],
            'descripcion_pqr' => $datos['descripcion'],
            'estado' => 'recibida',
            'fecha' => now()->toDateString(),
        ]);

        return redirect()->route('pqr.create')->with('ok', "Recibimos tu solicitud con radicado {$pqr->radicado}. Te responderemos en máximo 15 días hábiles.");
    }
}
