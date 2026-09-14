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

    public function index()
    {
        return response()->json(
            $this->categoriaService->getAll()
        );
    }

    public function show(int $id)
    {
        return response()->json(
            $this->categoriaService->getById($id)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_categoria' => 'required|string|max:40',
            'descripcion_categoria' => 'nullable|string|max:255',
        ]);

        return response()->json(
            $this->categoriaService->create($data),
            201
        );
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'nombre_categoria' => 'sometimes|string|max:40',
            'descripcion_categoria' => 'sometimes|nullable|string|max:255',
        ]);

        return response()->json(
            $this->categoriaService->update($id, $data)
        );
    }

    public function destroy(int $id)
    {
        $this->categoriaService->delete($id);

        return response()->json([
            'message' => 'Categoría eliminada correctamente'
        ]);
    }

    public function getByNombreCategoria(string $nombre_categoria)
    {
        return response()->json(
            $this->categoriaService->getByNombreCategoria($nombre_categoria)
        );
    }

    public function getByDescripcionCategoria(string $descripcion_categoria)
    {
        return response()->json(
            $this->categoriaService->getByDescripcionCategoria($descripcion_categoria)
        );
    }
}