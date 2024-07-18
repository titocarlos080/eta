<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
    public function estudiantesPorCarrera()
    {

        // Consulta para obtener los datos

        $data = DB::table('carreras')
            ->join('carrera_estudiantes', 'carreras.sigla', '=', 'carrera_estudiantes.carrera_sigla')
            ->select(DB::raw('carreras.descripcion as carrera, COUNT(carrera_estudiantes.estudiante_ci) as total_estudiantes'))
            ->groupBy('carreras.descripcion')
            ->get();
        Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
        return view('estadisticas.estudiante-carrera', compact('data', 'visitas'));
    }
    
    public function mostrarEstudiantesPorMateria()
    {
        $data = DB::table('materias')
            ->join('estudiante_materia', 'materias.sigla', '=', 'estudiante_materia.materia_sigla')
            ->select('materias.descripcion as materia', DB::raw('COUNT(estudiante_materia.estudiante_ci) as total_estudiantes'))
            ->groupBy('materias.descripcion')
            ->get();

        return view('estadisticas.estudiantes-materia', compact('data'));
    }

    public function egresosPorGestion()
    {
        Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
        // Consulta para obtener los datos de egresos por gestión
        $data = DB::table('egresos')
            ->join('gestiones', 'egresos.gestion_codigo', '=', 'gestiones.codigo')
            ->select(DB::raw('gestiones.descripcion as gestion, SUM(egresos.monto) as total_egresos'))
            ->groupBy('gestiones.descripcion')
            ->get();

        return view('estadisticas.egresos-gestion', compact('data', 'visitas'));
    }
}
