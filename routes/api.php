<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LinkController;
use App\Http\Controllers\API\OpenController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function(){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::middleware('auth:sanctum')->group(function(){
        Route::get('logout', [AuthController::class, 'logout']);
    });
});

Route::get('/open/{slug}', [OpenController::class, 'open']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('user', [UserController::class, 'get']);
    Route::apiResource('links', LinkController::class);
});
