<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\VideosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/** AUTH */
Route::get('/token', [ApiController::class, 'token'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    /** API */
    Route::prefix('url')->controller(ApiController::class)->group(function () {
        Route::post('/', 'add');
    });
    /** ARTICLES */
    Route::prefix('articles')->controller(ArticlesController::class)->group(function () {
        Route::get('/list', 'list');
        Route::post('/mark_as_read', 'read');
    });
    /** VIDEOS */
    Route::prefix('videos')->controller(VideosController::class)->group(function () {
        Route::get('/list', 'list');
        Route::post('/mark_as_watch', 'watch');
    });
});
