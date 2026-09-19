<?php

namespace App\Http\Controllers;

use App\Services\CategoriaService;
use App\Http\Requests\Categoria\StoreCategoriaRequest;
use App\Http\Requests\Categoria\UpdateCategoriaRequest;

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
    public function store(StoreCategoriaRequest $request)
    {   
        $data = $request->validated();

        return response()->json([
            'success' => 'Categoría creada correctamente',
            'data' => $this->categoriaService->create($data)
        ], 201);
    }

    public function update(UpdateCategoriaRequest $request, int $id)
    {
        $data = $request->validated();

        $resultado = $this->categoriaService->update($data, $id);

        if ($resultado === null) {
            return response()->json([
                'message' => 'Categoría no encontrada'
            ], 404);
        }

        if ($resultado['ya_actualizado'] === true) {
            return response()->json([
                'message' => 'La categoría ya se encuentra actualizada',
                'data' => $resultado['categoria']
            ]);
        }

        return response()->json([
            'message' => 'Categoría actualizada correctamente',
            'data' => $resultado['categoria']
        ]);
    }

    /**
     * Eliminar una categoría.
     */
    public function destroy(int $id)
    {
        $resultado = $this->categoriaService->delete($id);

        return $this->respuestaEliminacion(
            $resultado,
            'Categoría'
        );
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