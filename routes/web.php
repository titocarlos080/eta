<?php

use App\Http\Controllers\AdministrativoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\CarreraEstudianteController;
use App\Http\Controllers\CarreraMateriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NivelesController;
use App\Http\Controllers\CarrerasController;
use App\Http\Controllers\ConsumirServicioController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\GrupoMateriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleMenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\MateriaEstudianteController;
use App\Http\Controllers\EgresoController;
use App\Http\Controllers\OfertaController;
use App\Models\Materia;

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

     Route::post('/consumirServicio', [ConsumirServicioController::class, 'RecolectarDatos']);
    Route::post('/consultar', [ConsumirServicioController::class, 'ConsultarEstado']);
 

    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::resource('niveles', NivelesController::class);
    Route::resource('materias', MateriaController::class);
    Route::resource('gestiones', GestionController::class);
    Route::resource('carreras', CarreraController::class);
    Route::resource('permisos', RoleMenuController::class);
    Route::resource('horarios', HorarioController::class);
    Route::resource('carrera_materias', CarreraMateriaController::class);
    Route::resource('carrera_estudiantes', CarreraEstudianteController::class);
    Route::resource('materia_estudiantes', MateriaEstudianteController::class);
    Route::resource('grupo_materias', GrupoMateriaController::class);
     
    Route::resource('roles', RoleController::class);
   
    Route::resource('usuarios', UserController::class);
   
    Route::resource('estudiantes', EstudianteController::class); 
  //  Route::get('/search-estudiantes', [EstudianteController::class, 'search'])->name('search.estudiantes');
    Route::resource('administrativos', AdministrativoController::class);
    Route::resource('docentes', DocenteController::class);
    Route::resource('menus', MenuController::class);

    // Pagos
    Route::get('/search', [PagosController::class, 'search']);
    Route::get('/pagos/qr', [PagosController::class, 'pagarQr']);
     Route::get('/pagos/lista', [PagosController::class, 'lista'])->name('pagos.lista');
    Route::resource('pagos', PagosController::class);
    Route::get('getEstudianteInfo/{id}', [PagosController::class, 'getEstudianteInfo']);

    //estadisticas
    Route::get('/estadisticas/estudiantes', [EstadisticasController::class, 'estudiantesPorCarrera'])->name('estadisticas.estudiantes');
    Route::get('/estadisticas/estudiantes_materia', [EstadisticasController::class, 'mostrarEstudiantesPorMateria']);
    Route::get('/estadisticas/egresos_gestion', [EstadisticasController::class, 'egresosPorGestion']);

    //egresos
    Route::resource('egresos', EgresoController::class);
    Route::post('egresos/{egreso}/anular', [EgresoController::class, 'anular'])->name('egresos.anular');
    //ofertas
    
    Route::get('ofertas', [OfertaController::class, 'index'])->name('ofertas.index');
Route::get('ofertas/create', [OfertaController::class, 'create'])->name('ofertas.create');
Route::get('ofertas/{gestionCodigo}/carreras', [OfertaController::class, 'showCarreras'])->name('ofertas.showCarreras');
Route::get('ofertas/{carreraSigla}/materias', [OfertaController::class, 'showMaterias'])->name('ofertas.showMaterias');
Route::resource('ofertas', OfertaController::class);
    
});
