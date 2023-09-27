<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\TypeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [AuthController::class, 'logout']);

        Route::get('type', [TypeController::class, 'index']);
        Route::get('type/{id}', [TypeController::class, 'show']);
        Route::post('type', [TypeController::class, 'store']);
        Route::put('type/{id}', [TypeController::class, 'update']);
        Route::delete('type/{id}', [TypeController::class, 'destroy']);

        Route::get('quote', [QuoteController::class, 'index']);
        Route::get('quote/{id}', [QuoteController::class, 'show']);
        Route::post('quote', [QuoteController::class, 'store']);
        Route::put('quote/{id}', [QuoteController::class, 'update']);
        Route::delete('quote/{id}', [QuoteController::class, 'destroy']);
    });
});
