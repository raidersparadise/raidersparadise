<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * CRUD genérico para las tablas maestras sencillas: categorías, marcas y proveedores.
 * Las rutas son /admin/maestros/{tipo}.
 */
class MaestroController extends Controller
{
    private const CONFIG = [
        'categorias' => [
            'modelo' => Categoria::class, 'tabla' => 'categoria', 'pk' => 'id_categoria',
            'singular' => 'categoría', 'plural' => 'Categorías', 'orden' => 'nombre_categoria',
            'campos' => [
                'nombre_categoria' => ['Nombre', 'text', ['required', 'string', 'max:40'], true],
                'descripcion_categoria' => ['Descripción', 'textarea', ['nullable', 'string', 'max:255'], false],
            ],
        ],
        'marcas' => [
            'modelo' => Marca::class, 'tabla' => 'marca', 'pk' => 'id_marca',
            'singular' => 'marca', 'plural' => 'Marcas', 'orden' => 'nombre_marca',
            'campos' => [
                'nombre_marca' => ['Nombre', 'text', ['required', 'string', 'max:40'], true],
                'descripcion_marca' => ['Descripción', 'textarea', ['nullable', 'string', 'max:255'], false],
            ],
        ],
        'proveedores' => [
            'modelo' => Proveedor::class, 'tabla' => 'proveedor', 'pk' => 'id_proveedor',
            'singular' => 'proveedor', 'plural' => 'Proveedores', 'orden' => 'nombre_proveedor',
            'campos' => [
                'nombre_proveedor' => ['Razón social', 'text', ['required', 'string', 'max:80'], false],
                'nit' => ['NIT', 'text', ['nullable', 'string', 'max:20'], false],
                'telefono_proveedor' => ['Teléfono', 'text', ['nullable', 'string', 'max:20'], false],
                'email_proveedor' => ['Correo', 'email', ['nullable', 'email', 'max:100'], false],
                'direccion_proveedor' => ['Dirección', 'text', ['nullable', 'string', 'max:100'], false],
            ],
        ],
    ];

    private function cfg(string $tipo): array
    {
        abort_unless(isset(self::CONFIG[$tipo]), 404);

        return self::CONFIG[$tipo] + ['tipo' => $tipo];
    }

    public function index(string $tipo)
    {
        $cfg = $this->cfg($tipo);
        $registros = $cfg['modelo']::withCount('productos')->orderBy($cfg['orden'])->get();

        return view('admin.maestros.index', compact('cfg', 'registros'));
    }

    public function create(string $tipo)
    {
        $cfg = $this->cfg($tipo);
        $registro = new $cfg['modelo'];

        return view('admin.maestros.form', compact('cfg', 'registro'));
    }

    public function store(Request $request, string $tipo)
    {
        $cfg = $this->cfg($tipo);
        $cfg['modelo']::create($request->validate($this->reglas($cfg)));

        return redirect()->route('admin.maestros.index', $tipo)->with('ok', ucfirst($cfg['singular']).' creada correctamente.');
    }

    public function edit(string $tipo, int $id)
    {
        $cfg = $this->cfg($tipo);
        $registro = $cfg['modelo']::findOrFail($id);

        return view('admin.maestros.form', compact('cfg', 'registro'));
    }

    public function update(Request $request, string $tipo, int $id)
    {
        $cfg = $this->cfg($tipo);
        $registro = $cfg['modelo']::findOrFail($id);
        $registro->update($request->validate($this->reglas($cfg, $id)));

        return redirect()->route('admin.maestros.index', $tipo)->with('ok', 'Cambios guardados.');
    }

    public function destroy(string $tipo, int $id)
    {
        $cfg = $this->cfg($tipo);
        $registro = $cfg['modelo']::findOrFail($id);

        if ($registro->productos()->exists()) {
            return back()->with('error', "No se puede eliminar: hay productos asociados a esta {$cfg['singular']}.");
        }
        $registro->delete();

        return back()->with('ok', 'Registro eliminado.');
    }

    private function reglas(array $cfg, ?int $id = null): array
    {
        $reglas = [];
        foreach ($cfg['campos'] as $campo => [$label, $tipoCampo, $r, $unico]) {
            if ($unico) {
                $r[] = Rule::unique($cfg['tabla'], $campo)->ignore($id, $cfg['pk']);
            }
            $reglas[$campo] = $r;
        }

        return $reglas;
    }
}
