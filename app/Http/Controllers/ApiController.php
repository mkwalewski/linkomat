<?php

namespace App\Http\Controllers;

use App\Exceptions\DuplicateException;
use App\Exceptions\NoParserException;
use App\Services\ParserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json(['token' => $token], 201);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function add(Request $request, ParserService $parserService): JsonResponse
    {
        $requestData = $request->validate([
            'url' => ['string'],
            'date' => ['numeric'],
        ]);

        if (!isset($requestData['url'])) {
            return response()->json(['message' => 'Musisz podać url!'], 400);
        }

        try {
            $id = $parserService->parse($requestData);
        } catch (NoParserException $exception) {
            return response()->json(['message' => $exception->getMessage()], 501);
        } catch (DuplicateException $exception) {
            return response()->json(['message' => $exception->getMessage()], 409);
        } catch (\Exception $exception) {
            report($exception);

            return response()->json(['message' => 'Błąd przy dodawaniu urla!'], 500);
        }

        return response()->json([
            'id' => $id,
            'message' => 'Url został pomyślnie dodany',
        ], 201);
    }
}
