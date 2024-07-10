<?php

 use App\Http\Controllers\AdministrativoController;
 use App\Http\Controllers\AuthController;
 use App\Http\Controllers\CarreraController;
 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\NivelesController;
 use App\Http\Controllers\CarrerasController;
 use App\Http\Controllers\DocenteController;
 use App\Http\Controllers\EstudianteController;
 use App\Http\Controllers\GestionController;
 use App\Http\Controllers\HomeController;
 use App\Http\Controllers\MenuController;
 use App\Http\Controllers\PagosController;
 use App\Http\Controllers\RoleController;
 use App\Http\Controllers\UserController;
 
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
 
 // Rutas de autenticación
 Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
 Route::post('/login', [AuthController::class, 'login']);
 Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
 
 // Ruta para generar PDF de pagos
 Route::get('/pagos/pdf', [PagosController::class, 'pdf'])->name('pagos.pdf');
 
 // Rutas protegidas por el middleware de autenticación
 Route::middleware(['auth.eta'])->group(function () {
     
     Route::get('/', [HomeController::class, 'home'])->name('home');
     Route::resource('niveles', NivelesController::class);
     Route::resource('gestiones', GestionController::class);
     Route::resource('carreras', CarreraController::class);
 
     Route::resource('roles', RoleController::class);
     Route::resource('users', UserController::class);
     Route::resource('estudiantes', EstudianteController::class);
     Route::resource('administrativos', AdministrativoController::class);
     Route::resource('docentes', DocenteController::class);
     Route::resource('menus', MenuController::class);
 
     // Pagos
     Route::get('/search', [PagosController::class, 'search']);
     Route::get('/pagos/lista', [PagosController::class, 'lista'])->name('pagos.lista');
     Route::resource('pagos', PagosController::class);
     Route::get('getEstudianteInfo/{id}', [PagosController::class, 'getEstudianteInfo']);
 });
 
