<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NivelesController;
use App\Http\Controllers\CarrerasController;
use App\Http\Controllers\EstudiantesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/pagos/pdf', [PagosController::class, 'pdf'])->name('pagos.pdf');

//auth.eta


Route::middleware(['auth.eta'])->group(function () {
    Route::resource('niveles', NivelesController::class);
    Route::resource('carreras', CarrerasController::class);
    Route::resource('estudiantes', EstudiantesController::class);
    //pagos
    Route::get('/search', [PagosController::class, 'search']);
    Route::get('/pagos/lista', [PagosController::class, 'lista'])->name('pagos.lista');
    Route::resource('pagos', PagosController::class);
    Route::get('getEstudianteInfo/{id}', [PagosController::class, 'getEstudianteInfo']);
});
