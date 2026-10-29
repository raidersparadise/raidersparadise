<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Inventario;
use App\Models\Pedido;
use App\Models\Pqr;
use App\Services\ReporteService;

class DashboardController extends Controller
{
    public function index(ReporteService $reportes)
    {
        $inicioMes = now()->startOfMonth();
        $inicioMesAnterior = now()->subMonthNoOverflow()->startOfMonth();
        $finMesAnterior = now()->subMonthNoOverflow()->endOfMonth();

        $ventasMes = Pedido::where('estado', '!=', 'cancelado')->where('fecha', '>=', $inicioMes)->sum('total');
        $ventasMesAnterior = Pedido::where('estado', '!=', 'cancelado')->whereBetween('fecha', [$inicioMesAnterior, $finMesAnterior])->sum('total');
        $pedidosMes = Pedido::where('estado', '!=', 'cancelado')->where('fecha', '>=', $inicioMes)->count();

        $kpis = [
            'ventas_mes' => (float) $ventasMes,
            'variacion' => $ventasMesAnterior > 0 ? (($ventasMes - $ventasMesAnterior) / $ventasMesAnterior) : null,
            'pedidos_mes' => $pedidosMes,
            'ticket' => $pedidosMes ? $ventasMes / $pedidosMes : 0,
            'por_despachar' => Pedido::whereIn('estado', ['pendiente', 'programado'])->count(),
            'clientes' => Cliente::count(),
            'stock_bajo' => Inventario::whereColumn('cantidad_disponible', '<=', 'cantidad_minima')->count(),
            'pqr_abiertas' => Pqr::whereNotIn('estado', ['cerrada', 'rechazada'])->count(),
        ];

        $ventas30 = $reportes->generar('ventas', now()->subDays(29), now())['grafica'];
        $categorias = $reportes->generar('categorias', now()->subDays(89), now())['grafica'];

        $ultimosPedidos = Pedido::with('cliente')->latest('fecha')->take(6)->get();
        $alertasStock = Inventario::with('producto')
            ->whereColumn('cantidad_disponible', '<=', 'cantidad_minima')
            ->orderBy('cantidad_disponible')->take(6)->get();

        return view('admin.dashboard', compact('kpis', 'ventas30', 'categorias', 'ultimosPedidos', 'alertasStock'));
    }
}
