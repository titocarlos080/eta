<?php

namespace App\Http\Controllers;
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

        return view('estadisticas.estudiante-carrera', compact('data'));
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

    public function mostrarEgresosPorGestion()
    {
        $data = DB::table('gestiones')
            ->join('egresos', 'gestiones.codigo', '=', 'egresos.gestion_codigo')
            ->select('gestiones.descripcion as gestion', DB::raw('SUM(egresos.monto) as total_egresos'))
            ->groupBy('gestiones.descripcion')
            ->get();

        return view('estadisticas.egresos-gestion', compact('data'));
    }
}
