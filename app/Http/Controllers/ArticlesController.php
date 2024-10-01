<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function list(): JsonResponse
    {
        $articles = Articles::all();

        return response()->json($articles);
    }

    public function read(Request $request): JsonResponse
    {
        $id = (int)$request->post('id');

        if ($id) {
            try {
                $article = Articles::findOrFail($id);
                $article->read_at = new Carbon('now');
                $article->save();
            } catch (\Exception $exception) {
                report($exception);

                return response()->json(['message' => 'Błąd przy oznaczaniu artykułu!'], 500);
            }

            return response()->json([
                'id' => $id,
                'message' => 'Pomyślnie oznaczono artykuł jako przeczytany',
            ], 200);
        }

        return response()->json(['message' => 'Musisz podać id!'], 400);
    }
}
