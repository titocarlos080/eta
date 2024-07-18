<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Pagina;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    
    public function home(){
      Pagina::contarPagina(request()->path());
      $pagina = Pagina::where('path', request()->path())->first();
      $visitas = $pagina ? $pagina->visitas : 0;

      $cantidadEstudiantes= Estudiante::count();

      return view("home",compact('cantidadEstudiantes','visitas'));
    }
}
