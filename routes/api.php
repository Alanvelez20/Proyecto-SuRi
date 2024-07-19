<?php

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
use App\Http\Controllers\Api\LoteController;
use App\Http\Controllers\Api\AnimalController;
use App\Http\Controllers\Api\VentaController;

Route::get('lote/{lote}/animales', [LoteController::class, 'getAnimales']);
Route::get('animal/{animal}', [AnimalController::class, 'show']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
