<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 15);
        $perPage = min(max((int) $perPage, 1), 100); // Limitar entre 1 y 100

        $noticias = Noticia::query()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $noticias->items(),
            'pagination' => [
                'current_page' => $noticias->currentPage(),
                'per_page' => $noticias->perPage(),
                'total' => $noticias->total(),
                'last_page' => $noticias->lastPage(),
                'from' => $noticias->firstItem(),
                'to' => $noticias->lastItem(),
            ],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $noticia = Noticia::where('id', $id)
            ->orWhere('slug', $id)
            ->first();

        if (!$noticia) {
            return response()->json([
                'success' => false,
                'message' => 'Noticia no encontrada',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $noticia,
        ]);
    }
}
