<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pqr;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PqrController extends Controller
{
    public function index(Request $request)
    {
        $pqrs = Pqr::with('cliente', 'responsable')
            ->when($request->query('estado'), fn ($w, $e) => $w->where('estado', $e))
            ->when($request->query('tipo'), fn ($w, $t) => $w->where('tipo', $t))
            ->latest('fecha')->latest('id_pqr')->paginate(15)->withQueryString();

        return view('admin.pqr.index', compact('pqrs'));
    }

    public function show(Pqr $pqr)
    {
        $pqr->load('cliente', 'responsable');
        $personal = Usuario::whereHas('rol', fn ($r) => $r->whereIn('nombre_rol', [Rol::ADMIN, Rol::VENDEDOR]))->orderBy('nombre_usuario')->get();

        return view('admin.pqr.show', compact('pqr', 'personal'));
    }

    public function update(Request $request, Pqr $pqr)
    {
        $datos = $request->validate([
            'estado' => ['required', 'in:'.implode(',', Pqr::ESTADOS)],
            'id_usuario' => ['nullable', 'exists:usuario,id_usuario'],
            'respuesta' => ['nullable', 'string', 'max:2000', 'required_if:estado,cerrada,rechazada'],
        ], ['respuesta.required_if' => 'Escribe la respuesta al cliente antes de cerrar o rechazar la PQR.']);

        if ($datos['estado'] === 'recibida' && ! empty($datos['id_usuario'])) {
            $datos['estado'] = 'asignada';
        }
        $datos['fecha_cierre'] = in_array($datos['estado'], ['cerrada', 'rechazada']) ? ($pqr->fecha_cierre ?? now()) : null;

        $pqr->update($datos);

        return back()->with('ok', "PQR {$pqr->radicado} actualizada.");
    }
}
