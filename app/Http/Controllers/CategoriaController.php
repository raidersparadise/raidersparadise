<?php

namespace App\Http\Controllers;

use App\Services\CategoriaService;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    protected CategoriaService $categoriaService;

    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoriaService = $categoriaService;
    }

    /**
     * Listar todas las categorías.
     */
    public function index()
    {
        $categorias = $this->categoriaService->getAll();

        return response()->json([
            'success' => 'Categorías consultadas correctamente',
            'data' => $categorias
        ], 200);
    }

    /**
     * Consultar una categoría por ID.
     */
    public function show(int $id)
    {
        $categoria = $this->categoriaService->getById($id);

        return response()->json([
            'success' => 'Categoría encontrada correctamente',
            'data' => $categoria
        ], 200);
    }

    /**
     * Crear una nueva categoría.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_categoria' => 'required|string|max:40|unique:categoria,nombre_categoria',
            'descripcion_categoria' => 'nullable|string|max:255',
        ]);

        $categoria = $this->categoriaService->create($data);

        return response()->json([
            'success' => 'Categoría creada correctamente',
            'datosInsertado' => $categoria
        ], 201);
    }

    /**
     * Actualizar una categoría.
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'nombre_categoria' => 'required|string|max:40|unique:categoria,nombre_categoria',
            'descripcion_categoria' => 'nullable|string|max:255',
        ]);

        $categoria = $this->categoriaService->update($data, $id);

        return response()->json([
            'success' => 'Categoría actualizada correctamente',
            'data' => $categoria
        ], 200);
    }

    /**
     * Eliminar una categoría.
     */
    public function destroy(int $id)
    {
        $this->categoriaService->delete($id);

        return response()->json([
            'success' => 'Categoría eliminada correctamente'
        ], 200);
    }

    /**
     * Buscar categorías por nombre.
     */
    public function getByNombreCategoria(string $nombre_categoria)
    {
        $categorias = $this->categoriaService->getByNombreCategoria($nombre_categoria);

        return response()->json([
            'success' => 'Categorías filtradas por nombre correctamente',
            'data' => $categorias
        ], 200);
    }

    /**
     * Buscar categorías por descripción.
     */
    public function getByDescripcionCategoria(string $descripcion_categoria)
    {
        $categorias = $this->categoriaService->getByDescripcionCategoria($descripcion_categoria);

        return response()->json([
            'success' => 'Categorías filtradas por descripción correctamente',
            'data' => $categorias
        ], 200);
    }
}