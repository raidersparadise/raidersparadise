<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    protected function respuestaEliminacion(
        array $resultado,
        string $nombre = 'Dato'
    ): JsonResponse {

        if ($resultado['status'] === 'deleted') {
            return response()->json([
                'success' => true,
                'message' => $nombre . ' eliminado correctamente',
                'data' => $resultado['data']
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Dato no encontrado',
            'data' => null
        ], 404);
    }
}