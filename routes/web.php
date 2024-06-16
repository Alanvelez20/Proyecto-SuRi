<?php

use App\Http\Controllers\AlimentoController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ConsumoController;
use App\Http\Controllers\CorralController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\SitioController;
use App\Models\Consumo;
use App\Models\Corral;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('principal');
});

Route::get('/principal/{tipo?}', [SitioController::class, 'principal']);

Route::resource('animal', AnimalController::class);
Route::resource('alimento', AlimentoController::class);
Route::resource('lote', LoteController::class);
Route::resource('corral', CorralController::class);
Route::resource('consumo',ConsumoController::class);

Route::get('/search0',[ConsumoController::class,'search']);
Route::get('/search1',[AnimalController::class,'search']);
Route::get('/search2',[LoteController::class,'search']);
Route::get('/search3',[CorralController::class,'search']);
Route::get('/search4',[AlimentoController::class,'search']);

Route::get('alimento-descarga/{alimento}', [AlimentoController::class, 'descargar'])
    ->name('alimento.descarga');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/principal', function () {
        return view('principal');
    })->name('principal');
});
Route::get('/mi-plantilla/demo', function () {
    return view('demo');
});