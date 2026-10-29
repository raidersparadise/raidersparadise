<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function home()
    {
        $destacados = Producto::activos()->with('marca', 'inventario')->where('destacado', true)->latest()->take(8)->get();
        $categorias = Categoria::withCount(['productos' => fn ($q) => $q->activos()])->orderBy('nombre_categoria')->get();
        $marcas = Marca::orderBy('nombre_marca')->get();

        return view('tienda.home', compact('destacados', 'categorias', 'marcas'));
    }

    public function catalogo(Request $request)
    {
        $filtros = $request->validate([
            'q' => ['nullable', 'string', 'max:60'],
            'categoria' => ['nullable', 'integer'],
            'marca' => ['nullable', 'integer'],
            'min' => ['nullable', 'numeric', 'min:0'],
            'max' => ['nullable', 'numeric', 'min:0'],
            'orden' => ['nullable', 'in:recientes,precio_asc,precio_desc,nombre'],
        ]);

        $query = Producto::activos()->with('marca', 'categoria', 'inventario');

        if (! empty($filtros['q'])) {
            $q = $filtros['q'];
            $query->where(function ($w) use ($q) {
                $w->where('nombre_producto', 'like', "%{$q}%")
                    ->orWhere('descripcion_producto', 'like', "%{$q}%")
                    ->orWhereHas('marca', fn ($m) => $m->where('nombre_marca', 'like', "%{$q}%"));
            });
        }
        if (! empty($filtros['categoria'])) {
            $query->where('id_categoria', $filtros['categoria']);
        }
        if (! empty($filtros['marca'])) {
            $query->where('id_marca', $filtros['marca']);
        }
        if (isset($filtros['min'])) {
            $query->where('precio_producto', '>=', $filtros['min']);
        }
        if (isset($filtros['max'])) {
            $query->where('precio_producto', '<=', $filtros['max']);
        }

        match ($filtros['orden'] ?? 'recientes') {
            'precio_asc' => $query->orderBy('precio_producto'),
            'precio_desc' => $query->orderByDesc('precio_producto'),
            'nombre' => $query->orderBy('nombre_producto'),
            default => $query->latest('id_producto'),
        };

        $productos = $query->paginate(12)->withQueryString();
        $categorias = Categoria::orderBy('nombre_categoria')->get();
        $marcas = Marca::orderBy('nombre_marca')->get();
        $categoriaActual = isset($filtros['categoria']) ? $categorias->firstWhere('id_categoria', $filtros['categoria']) : null;

        return view('tienda.catalogo', compact('productos', 'categorias', 'marcas', 'filtros', 'categoriaActual'));
    }

    public function producto(Producto $producto)
    {
        abort_if($producto->estado_producto !== 'activo', 404);
        $producto->load('marca', 'categoria', 'inventario');

        $relacionados = Producto::activos()->with('marca', 'inventario')
            ->where('id_categoria', $producto->id_categoria)
            ->where('id_producto', '!=', $producto->id_producto)
            ->inRandomOrder()->take(4)->get();

        return view('tienda.producto', compact('producto', 'relacionados'));
    }
}
