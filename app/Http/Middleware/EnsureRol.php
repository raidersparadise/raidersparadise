<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Uso en rutas: ->middleware('rol:Administrador,Vendedor')
 */
class EnsureRol
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $usuario = $request->user();

        if (! $usuario || ! $usuario->tieneRol(...$roles)) {
            if ($usuario && in_array('Cliente', $roles, true)) {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'El carrito y las compras son exclusivos de cuentas de cliente.');
            }
            abort(403, 'No tienes permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}
