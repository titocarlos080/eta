<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Estudiante;
use App\Models\Pagina;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReporteController extends Controller
{
    public function index()
    {
        Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
        $carreras = Carrera::all();
        $estudiantes = Estudiante::all();
        return view('reportes.index', compact('visitas', 'carreras', 'estudiantes'));
    }
    public function exportar(Request $request)
    {
        // Lógica para generar el reporte en PDF o Excel
        if ($request->has('exportar_pdf')) {
            // Código para exportar a PDF
            // Ejemplo usando TCPDF o DomPDF
        } elseif ($request->has('exportar_excel')) {
            // Código para exportar a Excel
            dd("hOLA");
        }
    }
    public function EstudiantePorMateria(Request $request)
    {
    }
    public function mostrarEstudiantesPorMateria()
    {
    }

    public function egresosPorGestion()
    {
    }
}
