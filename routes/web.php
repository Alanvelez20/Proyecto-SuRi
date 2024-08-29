<?php

use App\Http\Controllers\AlimentoController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ConsumoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CorralController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\SitioController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TraspasoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;
use App\Models\Consumo;
use App\Models\Corral;
use App\Models\Venta;
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


Route::get('/principal/{tipo?}', [SitioController::class, 'principal']);

// Rutas para el menú de administración
Route::middleware('auth')->group(function () {
Route::get('/dashboard', function () {
    return view('principal');
});

Route::get('/menu/corral', function () {
    return view('menu.corral');
})->name('menu.corral');

Route::get('/menu/lote', function () {
    return view('menu.lote');
})->name('menu.lote');

Route::get('/menu/animal', function () {
    return view('menu.animal');
})->name('menu.animal');

Route::get('/menu/alimento', function () {
    return view('menu.alimento');
})->name('menu.alimento');

Route::get('/menu/consumo', function () {
    return view('menu.consumo');
})->name('menu.consumo');

Route::get('/menu/venta', function () {
    return view('menu.venta');
})->name('menu.venta');

Route::get('/menu/users', function () {
    return view('menu.users');
})->name('menu.users');
});

Route::get('/suscripcion', [SubscriptionController::class, 'showPlans'])->name('suscripcion.show');
Route::post('/suscripcion/procesar', [SubscriptionController::class, 'processSubscription'])->name('suscripcion.procesar');
Route::get('/pago/exito', [SubscriptionController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/pago/fallo', [SubscriptionController::class, 'paymentFailure'])->name('payment.failure');
Route::get('/pago/pendiente', [SubscriptionController::class, 'paymentPending'])->name('payment.pending');

Route::post('/suscripcion/send', [SubscriptionController::class, 'send'])->name('suscription.send');


Route::resource('animal', AnimalController::class);
Route::resource('alimento', AlimentoController::class);
Route::resource('lote', LoteController::class);
Route::resource('corral', CorralController::class);
Route::resource('consumo',ConsumoController::class);
Route::resource('traspaso',TraspasoController::class);
Route::resource('venta',VentaController::class);
Route::resource('user',UserController::class);

Route::get('/alimentos/agregar', [AlimentoController::class, 'ShowAgregar'])->name('alimento.ShowAgregar');
Route::post('/alimentos/agregar', [AlimentoController::class, 'AgregarCantidad'])->name('alimento.AgregarCantidad');
Route::get('/alimentos/{alimento}/add', [AlimentoController::class, 'ShowAdd'])->name('alimento.ShowAdd');
Route::post('/alimentos/{alimento}/add', [AlimentoController::class, 'AddQuantity'])->name('alimento.AddQuantity');
Route::get('/animales/{arete}', [VentaController::class, 'getAnimalData']);

Route::get('/search3',[CorralController::class,'search']);
Route::get('/search4',[AlimentoController::class,'search']);

Route::get('/animales-export', [AnimalController::class, 'export'])->name('animales.export');
Route::get('/alimentos/export', [AlimentoController::class, 'export'])->name('alimentos.export');
Route::get('/consumo-export', [ConsumoController::class, 'export'])->name('consumo.export');
Route::get('/venta-export', [VentaController::class, 'export'])->name('ventas.export');
Route::get('/lote-export', [LoteController::class, 'export'])->name('lotes.export');

Route::get('/alimentos-import', [AlimentoController::class, 'showImportForm'])->name('alimentos.import.form');
Route::post('/alimentos-import', [AlimentoController::class, 'import'])->name('alimentos.import');
Route::get('/animales-import', [AnimalController::class, 'showImportForm'])->name('animales.import.form');
Route::post('/animales-import', [AnimalController::class, 'import'])->name('animales.import');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::patch('/usuarios/{user}/toggleSubscription', [UserController::class, 'toggleSubscription'])->name('usuarios.toggleSubscription');
Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::post('/user/update-name', [UserController::class, 'updateName'])->name('user.updateName');
Route::post('/user/update-password', [UserController::class, 'updatePassword'])->name('user.updatePassword');

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