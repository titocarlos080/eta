<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\GrupoMateria;
use App\Models\MateriaEstudiante;
use App\Models\Pagina;
use Illuminate\Http\Request;

class MateriaEstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;

        $grupos = GrupoMateria::all();
        $materiasEstudiantes  = MateriaEstudiante::all();
        $estudiantes = Estudiante::all();


        return view('materia_estudiantes.index', compact('grupos', 'materiasEstudiantes', 'estudiantes', 'visitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario con mensajes personalizados
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'estudiante_ci' => 'required|string|max:20',
            'grupo_sigla' => 'required|string|max:10',
        ], [
            'fecha.required' => 'La fecha de inscripción es obligatoria.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
            'estudiante_ci.required' => 'El campo estudiante es obligatorio.',
            'estudiante_ci.string' => 'El campo estudiante debe ser una cadena de texto.',
            'estudiante_ci.max' => 'El campo estudiante no debe exceder los 20 caracteres.',
            'grupo_sigla.required' => 'El campo grupo es obligatorio.',
            'grupo_sigla.string' => 'El campo grupo debe ser una cadena de texto.',
            'grupo_sigla.max' => 'El campo grupo no debe exceder los 10 caracteres.',
        ]);

        // Crear un nuevo registro en la tabla estudiante_materia
        MateriaEstudiante::create([
            'fecha' => $validatedData['fecha'],
            'grupos_materias_sigla' => $validatedData['grupo_sigla'],
            'estudiante_ci' => $validatedData['estudiante_ci'],
        ]);

        // Definir un mensaje de éxito personalizado
        $successMessage = $request->input('success_message', 'Registro creado exitosamente.');

        // Redirigir al usuario con el mensaje de éxito
        return redirect()->route('materia_estudiantes.index')->with('success', $successMessage);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MateriaEstudiante  $materiaEstudiante
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Buscar el registro con el ID proporcionado
        $materiaEstudiante = MateriaEstudiante::find($id);
    
        // Verificar si el registro existe
        if (!$materiaEstudiante) {
            // Redirigir con un mensaje de error si no se encuentra el registro
            return redirect()->route('materia_estudiantes.index')->with('error', 'Registro no encontrado.');
        }
    
        // Pasar el registro a la vista
        return view('materia_estudiantes.show', compact('materiaEstudiante'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MateriaEstudiante  $materiaEstudiante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materia_estudiante = MateriaEstudiante::findOrFail($id);
        return response()->json($materia_estudiante);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MateriaEstudiante  $materiaEstudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,   $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MateriaEstudiante  $materiaEstudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
