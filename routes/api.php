<?php

use App\Domain\Translation\Controllers\API\LanguagesController;
use App\Domain\Translation\Controllers\API\TranslationController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->group(function () {
    // Route::middleware('auth:sanctum')->group(function () {
        Route::get('translations/export', [TranslationController::class, 'export']); // Export
        Route::post('translations/search', [TranslationController::class, 'search']); // Search
        Route::apiResource('translations', TranslationController::class);
        Route::apiResource('language', LanguagesController::class);
    // });
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
    });
});
