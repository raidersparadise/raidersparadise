<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $usuarios = Usuario::with('rol')
            ->when($request->query('rol'), fn ($w, $r) => $w->where('id_rol', $r))
            ->orderBy('id_rol')->orderBy('nombre_usuario')->paginate(20)->withQueryString();
        $roles = Rol::orderBy('id_rol')->get();

        return view('admin.usuarios.index', compact('usuarios', 'roles'));
    }

    public function create()
    {
        return view('admin.usuarios.form', ['usuario' => new Usuario(['activo' => true]), 'roles' => Rol::orderBy('id_rol')->get()]);
    }

    public function store(Request $request)
    {
        $datos = $this->validar($request);
        $usuario = Usuario::create($datos);
        if ($usuario->tieneRol(Rol::CLIENTE)) {
            $usuario->clienteAsociado();
        }

        return redirect()->route('admin.usuarios.index')->with('ok', 'Usuario creado.');
    }

    public function edit(Usuario $usuario)
    {
        return view('admin.usuarios.form', ['usuario' => $usuario, 'roles' => Rol::orderBy('id_rol')->get()]);
    }

    public function update(Request $request, Usuario $usuario)
    {
        $datos = $this->validar($request, $usuario);
        if (empty($datos['password'])) {
            unset($datos['password']);
        }
        if ($usuario->is($request->user()) && (! $datos['activo'] || (int) $datos['id_rol'] !== $usuario->id_rol)) {
            return back()->with('error', 'No puedes desactivarte ni cambiar tu propio rol.');
        }
        $usuario->update($datos);

        return redirect()->route('admin.usuarios.index')->with('ok', 'Usuario actualizado.');
    }

    public function destroy(Request $request, Usuario $usuario)
    {
        if ($usuario->is($request->user())) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }
        // Se desactiva para conservar trazabilidad (reportes, PQR atendidas, pedidos)
        $usuario->update(['activo' => false]);

        return back()->with('ok', "La cuenta de {$usuario->nombre_completo} fue desactivada.");
    }

    private function validar(Request $request, ?Usuario $usuario = null): array
    {
        $datos = $request->validate([
            'nombre_usuario' => ['required', 'string', 'max:40'],
            'apellido_usuario' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:100', Rule::unique('usuario', 'email')->ignore($usuario?->id_usuario, 'id_usuario')],
            'telefono' => ['nullable', 'string', 'max:20'],
            'id_rol' => ['required', 'exists:rol,id_rol'],
            'password' => [$usuario ? 'nullable' : 'required', 'confirmed', Password::min(8)->letters()->numbers()],
        ], [], ['nombre_usuario' => 'nombre', 'apellido_usuario' => 'apellido', 'id_rol' => 'rol', 'password' => 'contraseña']);
        $datos['activo'] = $request->boolean('activo');

        return $datos;
    }
}
