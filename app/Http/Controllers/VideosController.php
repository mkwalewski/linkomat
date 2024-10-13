<?php

namespace App\Http\Controllers;

use App\Models\Videos;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function list(): JsonResponse
    {
        $videos = Videos::where(['archived_at' => null])->get();

        return response()->json($videos);
    }

    public function watch(Request $request): JsonResponse
    {
        $id = (int)$request->post('id');

        if ($id) {
            try {
                $video = Videos::findOrFail($id);
                $video->watch_at = new Carbon('now');
                $video->save();
            } catch (\Exception $exception) {
                report($exception);

                return response()->json(['message' => 'Błąd przy oznaczaniu video!'], 500);
            }

            return response()->json([
                'id' => $id,
                'message' => 'Pomyślnie oznaczono video jako obejrzane',
            ], 200);
        }

        return response()->json(['message' => 'Musisz podać id!'], 400);
    }

    public function archived(Request $request): JsonResponse
    {
        $id = (int)$request->post('id');

        if ($id) {
            try {
                $video = Videos::findOrFail($id);
                $video->archived_at = new Carbon('now');
                $video->save();
            } catch (\Exception $exception) {
                report($exception);

                return response()->json(['message' => 'Błąd przy oznaczaniu video!'], 500);
            }

            return response()->json([
                'id' => $id,
                'message' => 'Pomyślnie oznaczono video jako zarchiwizowane',
            ], 200);
        }

        return response()->json(['message' => 'Musisz podać id!'], 400);
    }
}
