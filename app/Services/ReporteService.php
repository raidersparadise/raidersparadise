<?php

namespace App\Services;

use App\Models\Factura;
use App\Models\Inventario;
use App\Models\Pedido;
use App\Models\Pqr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

/**
 * Construye los datos de cada reporte gerencial. Todas las consultas son compatibles
 * con MySQL y SQLite. Cada reporte devuelve la misma estructura para que la vista,
 * la versión imprimible (PDF) y la exportación CSV/Excel usen un único origen.
 *
 * Tipos de columna: text | money | int | pct | date | estado
 */
class ReporteService
{
    public const TIPOS = [
        'ventas' => ['titulo' => 'Ventas por periodo', 'icono' => 'chart', 'descripcion' => 'Ventas diarias, número de pedidos y ticket promedio.', 'usa_fechas' => true],
        'productos' => ['titulo' => 'Productos más vendidos', 'icono' => 'star', 'descripcion' => 'Ranking de productos por unidades e ingresos.', 'usa_fechas' => true],
        'categorias' => ['titulo' => 'Ventas por categoría', 'icono' => 'grid', 'descripcion' => 'Participación de cada categoría en las ventas.', 'usa_fechas' => true],
        'clientes' => ['titulo' => 'Mejores clientes', 'icono' => 'users', 'descripcion' => 'Clientes ordenados por valor total comprado.', 'usa_fechas' => true],
        'pedidos' => ['titulo' => 'Pedidos por estado', 'icono' => 'truck', 'descripcion' => 'Detalle de pedidos y su estado de entrega.', 'usa_fechas' => true],
        'inventario' => ['titulo' => 'Estado del inventario', 'icono' => 'box', 'descripcion' => 'Existencias, mínimos, alertas y valor del inventario.', 'usa_fechas' => false],
        'pqr' => ['titulo' => 'Peticiones, quejas y reclamos', 'icono' => 'chat', 'descripcion' => 'Seguimiento de PQR por tipo, estado y tiempo de respuesta.', 'usa_fechas' => true],
    ];

    public function generar(string $tipo, Carbon $desde, Carbon $hasta): array
    {
        if (! array_key_exists($tipo, self::TIPOS)) {
            throw new InvalidArgumentException("Tipo de reporte no válido: {$tipo}");
        }

        $desde = $desde->copy()->startOfDay();
        $hasta = $hasta->copy()->endOfDay();

        $datos = $this->{'reporte'.ucfirst($tipo)}($desde, $hasta);

        return array_merge([
            'tipo' => $tipo,
            'titulo' => self::TIPOS[$tipo]['titulo'],
            'descripcion' => self::TIPOS[$tipo]['descripcion'],
            'usa_fechas' => self::TIPOS[$tipo]['usa_fechas'],
            'desde' => $desde,
            'hasta' => $hasta,
            'kpis' => [],
            'grafica' => null,
        ], $datos);
    }

    /** Pedidos válidos (no cancelados) dentro del rango. */
    private function pedidosValidos(Carbon $desde, Carbon $hasta)
    {
        return Pedido::query()
            ->where('estado', '!=', 'cancelado')
            ->whereBetween('fecha', [$desde, $hasta]);
    }

    private function reporteVentas(Carbon $desde, Carbon $hasta): array
    {
        $porDia = $this->pedidosValidos($desde, $hasta)
            ->selectRaw('DATE(fecha) as dia, COUNT(*) as pedidos, SUM(total) as total')
            ->groupBy(DB::raw('DATE(fecha)'))
            ->orderBy('dia')
            ->get()
            ->keyBy('dia');

        $unidades = DB::table('detalle_pedido as d')
            ->join('pedido as p', 'p.id_pedido', '=', 'd.id_pedido')
            ->where('p.estado', '!=', 'cancelado')
            ->whereBetween('p.fecha', [$desde, $hasta])
            ->selectRaw('DATE(p.fecha) as dia, SUM(d.cantidad) as unidades')
            ->groupBy(DB::raw('DATE(p.fecha)'))
            ->pluck('unidades', 'dia');

        $filas = [];
        $labels = [];
        $valores = [];
        // Serie continua (incluye días sin ventas) para que la gráfica sea honesta
        for ($d = $desde->copy(); $d->lte($hasta); $d->addDay()) {
            $k = $d->toDateString();
            $row = $porDia->get($k);
            $total = (float) ($row->total ?? 0);
            $pedidos = (int) ($row->pedidos ?? 0);
            $labels[] = $d->format('d/m');
            $valores[] = $total;
            if ($pedidos > 0) {
                $filas[] = [$k, $pedidos, (int) ($unidades[$k] ?? 0), $total, $pedidos ? $total / $pedidos : 0];
            }
        }

        $totalVentas = array_sum(array_column($filas, 3));
        $totalPedidos = array_sum(array_column($filas, 1));

        $iva = Factura::query()
            ->whereHas('pedido', fn ($q) => $q->where('estado', '!=', 'cancelado')->whereBetween('fecha', [$desde, $hasta]))
            ->sum('impuesto');

        $porMetodo = Factura::query()
            ->whereHas('pedido', fn ($q) => $q->where('estado', '!=', 'cancelado')->whereBetween('fecha', [$desde, $hasta]))
            ->selectRaw('metodo_pago, COUNT(*) as n')->groupBy('metodo_pago')->orderByDesc('n')->first();

        return [
            'kpis' => [
                ['Ventas totales', $totalVentas, 'money'],
                ['Pedidos', $totalPedidos, 'int'],
                ['Ticket promedio', $totalPedidos ? $totalVentas / $totalPedidos : 0, 'money'],
                ['IVA generado', (float) $iva, 'money'],
                ['Medio de pago más usado', $porMetodo ? (Factura::METODOS_PAGO[$porMetodo->metodo_pago] ?? $porMetodo->metodo_pago) : '—', 'text'],
            ],
            'columnas' => [['Fecha', 'date'], ['Pedidos', 'int'], ['Unidades', 'int'], ['Ventas', 'money'], ['Ticket promedio', 'money']],
            'filas' => $filas,
            'totales' => ['Total', $totalPedidos, array_sum(array_column($filas, 2)), $totalVentas, $totalPedidos ? $totalVentas / $totalPedidos : 0],
            'grafica' => ['tipo' => 'line', 'titulo' => 'Ventas diarias', 'labels' => $labels, 'valores' => $valores, 'formato' => 'money'],
        ];
    }

    private function reporteProductos(Carbon $desde, Carbon $hasta): array
    {
        $rows = DB::table('detalle_pedido as d')
            ->join('pedido as p', 'p.id_pedido', '=', 'd.id_pedido')
            ->join('producto as pr', 'pr.id_producto', '=', 'd.id_producto')
            ->join('categoria as c', 'c.id_categoria', '=', 'pr.id_categoria')
            ->join('marca as m', 'm.id_marca', '=', 'pr.id_marca')
            ->where('p.estado', '!=', 'cancelado')
            ->whereBetween('p.fecha', [$desde, $hasta])
            ->groupBy('pr.id_producto', 'pr.sku', 'pr.nombre_producto', 'c.nombre_categoria', 'm.nombre_marca')
            ->selectRaw('pr.sku, pr.nombre_producto, c.nombre_categoria, m.nombre_marca, SUM(d.cantidad) as unidades, SUM(d.sub_total) as ingresos')
            ->orderByDesc('ingresos')
            ->get();

        $total = (float) $rows->sum('ingresos');
        $filas = $rows->map(fn ($r) => [
            $r->sku, $r->nombre_producto, $r->nombre_categoria, $r->nombre_marca,
            (int) $r->unidades, (float) $r->ingresos, $total ? $r->ingresos / $total : 0,
        ])->all();

        $top = $rows->take(10);

        return [
            'kpis' => [
                ['Productos vendidos', $rows->count(), 'int'],
                ['Unidades', (int) $rows->sum('unidades'), 'int'],
                ['Ingresos', $total, 'money'],
                ['Producto líder', $rows->first()->nombre_producto ?? '—', 'text'],
            ],
            'columnas' => [['SKU', 'text'], ['Producto', 'text'], ['Categoría', 'text'], ['Marca', 'text'], ['Unidades', 'int'], ['Ingresos', 'money'], ['Participación', 'pct']],
            'filas' => $filas,
            'totales' => ['Total', '', '', '', (int) $rows->sum('unidades'), $total, $total ? 1 : 0],
            'grafica' => ['tipo' => 'bar', 'titulo' => 'Top 10 por ingresos', 'labels' => $top->pluck('nombre_producto')->all(), 'valores' => $top->pluck('ingresos')->map(fn ($v) => (float) $v)->all(), 'formato' => 'money'],
        ];
    }

    private function reporteCategorias(Carbon $desde, Carbon $hasta): array
    {
        $rows = DB::table('detalle_pedido as d')
            ->join('pedido as p', 'p.id_pedido', '=', 'd.id_pedido')
            ->join('producto as pr', 'pr.id_producto', '=', 'd.id_producto')
            ->join('categoria as c', 'c.id_categoria', '=', 'pr.id_categoria')
            ->where('p.estado', '!=', 'cancelado')
            ->whereBetween('p.fecha', [$desde, $hasta])
            ->groupBy('c.id_categoria', 'c.nombre_categoria')
            ->selectRaw('c.nombre_categoria, COUNT(DISTINCT p.id_pedido) as pedidos, SUM(d.cantidad) as unidades, SUM(d.sub_total) as ingresos')
            ->orderByDesc('ingresos')
            ->get();

        $total = (float) $rows->sum('ingresos');

        return [
            'kpis' => [
                ['Categorías con ventas', $rows->count(), 'int'],
                ['Ingresos', $total, 'money'],
                ['Categoría líder', $rows->first()->nombre_categoria ?? '—', 'text'],
            ],
            'columnas' => [['Categoría', 'text'], ['Pedidos', 'int'], ['Unidades', 'int'], ['Ingresos', 'money'], ['Participación', 'pct']],
            'filas' => $rows->map(fn ($r) => [$r->nombre_categoria, (int) $r->pedidos, (int) $r->unidades, (float) $r->ingresos, $total ? $r->ingresos / $total : 0])->all(),
            'totales' => ['Total', '', (int) $rows->sum('unidades'), $total, $total ? 1 : 0],
            'grafica' => ['tipo' => 'donut', 'titulo' => 'Participación por categoría', 'labels' => $rows->pluck('nombre_categoria')->all(), 'valores' => $rows->pluck('ingresos')->map(fn ($v) => (float) $v)->all(), 'formato' => 'money'],
        ];
    }

    private function reporteClientes(Carbon $desde, Carbon $hasta): array
    {
        $rows = DB::table('pedido as p')
            ->join('cliente as c', 'c.id_cliente', '=', 'p.id_cliente')
            ->where('p.estado', '!=', 'cancelado')
            ->whereBetween('p.fecha', [$desde, $hasta])
            ->groupBy('c.id_cliente', 'c.nombre_cliente', 'c.apellido_cliente', 'c.email', 'c.ciudad')
            ->selectRaw('c.nombre_cliente, c.apellido_cliente, c.email, c.ciudad, COUNT(*) as pedidos, SUM(p.total) as total, MAX(p.fecha) as ultima')
            ->orderByDesc('total')
            ->get();

        $total = (float) $rows->sum('total');
        $top = $rows->take(10);

        return [
            'kpis' => [
                ['Clientes que compraron', $rows->count(), 'int'],
                ['Ventas', $total, 'money'],
                ['Promedio por cliente', $rows->count() ? $total / $rows->count() : 0, 'money'],
            ],
            'columnas' => [['Cliente', 'text'], ['Correo', 'text'], ['Ciudad', 'text'], ['Pedidos', 'int'], ['Total comprado', 'money'], ['Última compra', 'date']],
            'filas' => $rows->map(fn ($r) => [$r->nombre_cliente.' '.$r->apellido_cliente, $r->email, $r->ciudad ?? '—', (int) $r->pedidos, (float) $r->total, substr((string) $r->ultima, 0, 10)])->all(),
            'totales' => ['Total', '', '', (int) $rows->sum('pedidos'), $total, ''],
            'grafica' => ['tipo' => 'bar', 'titulo' => 'Top clientes', 'labels' => $top->map(fn ($r) => $r->nombre_cliente.' '.$r->apellido_cliente)->all(), 'valores' => $top->pluck('total')->map(fn ($v) => (float) $v)->all(), 'formato' => 'money'],
        ];
    }

    private function reportePedidos(Carbon $desde, Carbon $hasta): array
    {
        $pedidos = Pedido::with(['cliente', 'factura'])
            ->whereBetween('fecha', [$desde, $hasta])
            ->orderByDesc('fecha')
            ->get();

        $conteo = [];
        foreach (Pedido::ESTADOS as $k => $txt) {
            $conteo[$txt] = $pedidos->where('estado', $k)->count();
        }

        return [
            'kpis' => [
                ['Pedidos', $pedidos->count(), 'int'],
                ['Entregados', $pedidos->where('estado', 'entregado')->count(), 'int'],
                ['En proceso', $pedidos->whereIn('estado', ['pendiente', 'programado', 'en_curso'])->count(), 'int'],
                ['Cancelados', $pedidos->where('estado', 'cancelado')->count(), 'int'],
            ],
            'columnas' => [['Pedido', 'text'], ['Fecha', 'date'], ['Cliente', 'text'], ['Ciudad', 'text'], ['Medio de pago', 'text'], ['Estado', 'estado'], ['Total', 'money']],
            'filas' => $pedidos->map(fn ($p) => [
                $p->codigo, $p->fecha->toDateString(), $p->cliente?->nombre_completo, $p->ciudad_envio ?? '—',
                $p->factura?->metodo_pago_texto ?? '—', $p->estado_texto, (float) $p->total,
            ])->all(),
            'totales' => ['Total', '', '', '', '', '', (float) $pedidos->where('estado', '!=', 'cancelado')->sum('total')],
            'grafica' => ['tipo' => 'donut', 'titulo' => 'Pedidos por estado', 'labels' => array_keys($conteo), 'valores' => array_values($conteo), 'formato' => 'int'],
        ];
    }

    private function reporteInventario(Carbon $desde, Carbon $hasta): array
    {
        $items = Inventario::with('producto.categoria', 'producto.marca')->get()
            ->sortBy(fn ($i) => [$i->nivel === 'ok' ? 2 : ($i->nivel === 'bajo' ? 1 : 0), $i->producto->nombre_producto])
            ->values();

        $niveles = ['Agotado' => 0, 'Stock bajo' => 0, 'Normal' => 0];
        $filas = [];
        $valorTotal = 0;
        foreach ($items as $i) {
            $txt = ['agotado' => 'Agotado', 'bajo' => 'Stock bajo', 'ok' => 'Normal'][$i->nivel];
            $niveles[$txt]++;
            $valor = $i->cantidad_disponible * (float) $i->producto->precio_producto;
            $valorTotal += $valor;
            $filas[] = [$i->producto->sku, $i->producto->nombre_producto, $i->producto->categoria->nombre_categoria, $i->producto->marca->nombre_marca, $i->cantidad_disponible, $i->cantidad_minima, $txt, $valor];
        }

        return [
            'kpis' => [
                ['Referencias', $items->count(), 'int'],
                ['Unidades en bodega', (int) $items->sum('cantidad_disponible'), 'int'],
                ['Valor del inventario', $valorTotal, 'money'],
                ['Requieren reposición', $niveles['Agotado'] + $niveles['Stock bajo'], 'int'],
            ],
            'columnas' => [['SKU', 'text'], ['Producto', 'text'], ['Categoría', 'text'], ['Marca', 'text'], ['Disponible', 'int'], ['Mínimo', 'int'], ['Estado', 'estado'], ['Valor a precio venta', 'money']],
            'filas' => $filas,
            'totales' => ['Total', '', '', '', (int) $items->sum('cantidad_disponible'), '', '', $valorTotal],
            'grafica' => ['tipo' => 'donut', 'titulo' => 'Estado de existencias', 'labels' => array_keys($niveles), 'valores' => array_values($niveles), 'formato' => 'int'],
        ];
    }

    private function reportePqr(Carbon $desde, Carbon $hasta): array
    {
        $pqrs = Pqr::with('cliente', 'responsable')
            ->whereBetween('fecha', [$desde->toDateString(), $hasta->toDateString()])
            ->orderByDesc('fecha')
            ->get();

        $porTipo = [];
        foreach (Pqr::TIPOS as $k => $txt) {
            $porTipo[$txt] = $pqrs->where('tipo', $k)->count();
        }

        $cerradas = $pqrs->whereNotNull('fecha_cierre');
        $promedioDias = $cerradas->count()
            ? round($cerradas->avg(fn ($p) => $p->fecha->diffInDays($p->fecha_cierre)), 1)
            : 0;

        return [
            'kpis' => [
                ['PQR recibidas', $pqrs->count(), 'int'],
                ['Abiertas', $pqrs->whereNotIn('estado', ['cerrada', 'rechazada'])->count(), 'int'],
                ['Cerradas', $pqrs->where('estado', 'cerrada')->count(), 'int'],
                ['Días promedio de respuesta', $promedioDias, 'text'],
            ],
            'columnas' => [['Radicado', 'text'], ['Fecha', 'date'], ['Cliente', 'text'], ['Tipo', 'text'], ['Asunto', 'text'], ['Estado', 'estado'], ['Responsable', 'text']],
            'filas' => $pqrs->map(fn ($p) => [
                $p->radicado, $p->fecha->toDateString(), $p->cliente?->nombre_completo, $p->tipo_texto, $p->asunto,
                ucfirst($p->estado), $p->responsable?->nombre_completo ?? 'Sin asignar',
            ])->all(),
            'totales' => null,
            'grafica' => ['tipo' => 'donut', 'titulo' => 'PQR por tipo', 'labels' => array_keys($porTipo), 'valores' => array_values($porTipo), 'formato' => 'int'],
        ];
    }
}
