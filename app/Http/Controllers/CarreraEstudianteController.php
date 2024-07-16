<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\CarreraEstudiante;
use App\Models\Estudiante;
use App\Models\Pagina;
use Illuminate\Http\Request;

class CarreraEstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // Contar visitas de la página actual
        Pagina::contarPagina(request()->path());

        $carreras = Carrera::all();
        $estudiantes = Estudiante::all();  
        $carreraEstudiantes  = CarreraEstudiante::all();  
        // Obtener el número de visitas para la página actual
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;

        return view('carrera_estudiantes.index', compact('carreras','carreraEstudiantes', 'estudiantes', 'visitas'));
    
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         //
        // Contar visitas de la página actual
        Pagina::contarPagina(request()->path());

        $carreras = Carrera::all();
        $estudiantes = Estudiante::all();  
        $carreraEstudiantes  = CarreraEstudiante::all();  
        // Obtener el número de visitas para la página actual
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;

        return view('carrera_estudiantes.index', compact('carreras','carreraEstudiantes', 'estudiantes', 'visitas'));
    
    


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'fecha_inscripcion' => 'required|date',
            'estudiante_ci' => 'required|string|max:20|exists:estudiantes,ci',
            'carrera_sigla' => 'required|string|max:255|exists:carreras,sigla',
        ], [
            'fecha_inscripcion.required' => 'La fecha de inscripción es obligatoria.',
            'fecha_inscripcion.date' => 'La fecha de inscripción debe ser una fecha válida.',
            'estudiante_ci.required' => 'El CI del estudiante es obligatorio.',
            'estudiante_ci.exists' => 'El CI del estudiante no existe en nuestra base de datos.',
            'carrera_sigla.required' => 'La sigla de la carrera es obligatoria.',
            'carrera_sigla.exists' => 'La sigla de la carrera no existe en nuestra base de datos.',
        ]);
    
        try {
            // Crear una nueva inscripción
            $inscripcion = new CarreraEstudiante();
            $inscripcion->fecha_inscripcion = $request->input('fecha_inscripcion');
            $inscripcion->estudiante_ci = $request->input('estudiante_ci');
            $inscripcion->carrera_sigla = $request->input('carrera_sigla');
            $inscripcion->save();
    
            // Redirigir al usuario con un mensaje de éxito
            return redirect()->route('carrera_estudiantes.index')->with('success', 'Inscripción creada exitosamente.');
        } catch (\Exception $e) {
            // Redirigir al usuario con un mensaje de error
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al crear la inscripción. Por favor, inténtelo de nuevo.']);
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarreraEstudiante  $carreraEstudiante
     * @return \Illuminate\Http\Response
     */
    public function show(  $id)
    {
        // Contar visitas de la página actual
        Pagina::contarPagina(request()->path());
         $inscripcion = CarreraEstudiante::findOrFail($id);    
    return view('carrera_estudiantes.show',compact('inscripcion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarreraEstudiante  $carreraEstudiante
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
       // Contar visitas de la página actual
      Pagina::contarPagina(request()->path());

      $inscripcion = CarreraEstudiante::find($id);
      return response()->json($inscripcion);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarreraEstudiante  $carreraEstudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'fecha_inscripcion' => 'required|date',
            'estudiante_ci' => 'required|string|max:20|exists:estudiantes,ci',
            'carrera_sigla' => 'required|string|max:255|exists:carreras,sigla',
        ], [
            'fecha_inscripcion.required' => 'La fecha de inscripción es obligatoria.',
            'fecha_inscripcion.date' => 'La fecha de inscripción debe ser una fecha válida.',
            'estudiante_ci.required' => 'El CI del estudiante es obligatorio.',
            'estudiante_ci.exists' => 'El CI del estudiante no existe en nuestra base de datos.',
            'carrera_sigla.required' => 'La sigla de la carrera es obligatoria.',
            'carrera_sigla.exists' => 'La sigla de la carrera no existe en nuestra base de datos.',
        ]);
    
        try {
            // Encontrar la inscripción por ID
            $inscripcion = CarreraEstudiante::findOrFail($id);
    
            // Actualizar los datos
            $inscripcion->fecha_inscripcion = $request->input('fecha_inscripcion');
            $inscripcion->estudiante_ci = $request->input('estudiante_ci');
            $inscripcion->carrera_sigla = $request->input('carrera_sigla');
            $inscripcion->save();
    
            // Redirigir al usuario con un mensaje de éxito
            return redirect()->route('carrera_estudiantes.index')->with('success', 'Inscripción actualizada exitosamente.');
        } catch (\Exception $e) {
            // Redirigir al usuario con un mensaje de error
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al actualizar la inscripción. Por favor, inténtelo de nuevo.']);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarreraEstudiante  $carreraEstudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Buscar el registro por ID
            $inscripcion = CarreraEstudiante::findOrFail($id);
    
            // Eliminar el registro
            $inscripcion->delete();
    
            // Redirigir al usuario con un mensaje de éxito
            return redirect()->route('carrera_estudiantes.index')->with('success', 'Inscripción eliminada exitosamente.');
        } catch (\Exception $e) {
            // Redirigir al usuario con un mensaje de error en caso de excepción
            return redirect()->route('carrera_estudiantes.index')->withErrors(['error' => 'Ocurrió un error al eliminar la inscripción. Por favor, inténtelo de nuevo.']);
        }
    }
    
}
