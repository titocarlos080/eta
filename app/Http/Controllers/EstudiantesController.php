<?php

namespace App\Http\Controllers;
use App\Models\Carreras;
use App\Models\Estudiante;
use App\Models\Estudiantes;
use App\Models\Niveles;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    
    public function index()
    {
        $estudiantes = Estudiante::with('carreras')->orderBy('id', 'asc')->paginate(9);
       // $carreras=Carreras::all();
       $carreras = Carreras::with('niveles')->get(); // Incluye los niveles
       
        return view('estudiantes.index', compact('estudiantes','carreras'));
    }

    
    public function create()
    {
        $estudiantes = Estudiante::get();
        
         $carreras = Carreras::with('niveles')->get();

        return view('estudiantes.create', compact('estudiantes','carreras','niveles'));
    }
    

    
    public function store(Request $request)
    {
       
    $request->validate([
        'nombre' => 'required',
        'apellidos' => 'required',
        'carnet' => 'required',
        'carrera_nivel' => 'required', 
    ]);

    $estudiante = Estudiante::create([
        'nombre' => $request->input('nombre'),
        'apellidos' => $request->input('apellidos'),
        'carnet' => $request->input('carnet'),
        'carrera_nivel' => $request->input('carrera_nivel'),
    ]);

   // list($carreraNombre) = explode('_', $request->input('carrera_nivel'));
   $carreraId = $request->input('carrera_nivel');
   $carrera = Carreras::find($carreraId);
    // Asociar estudiante con carrera (usando el nombre de la carrera)
    //$carrera = Carreras::where('nombre', $carreraNombre)->first();
    
    if ($carrera) {
        $estudiante->carreras()->attach($carrera->id);
    }

    return redirect()->route('estudiantes.index')->with('success', 'Estudiante creado exitosamente.');
    }

 
   
    public function edit($id)
    {
        $estudiante = Estudiante::with('carreras.niveles')->find($id);
        $carreras = Carreras::with('niveles')->get();
            return response()->json([
            'estudiante' => $estudiante,
            'carreras' => $carreras
         ]);
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'carnet' => 'required',
            'carrera_nivel' => 'required',
        ]);

        $estudiante = Estudiante::find($id);
        $estudiante->update($request->only(['nombre', 'apellidos', 'carnet', 'carrera_nivel']));
        $estudiante->carreras()->sync($request->input('carrera_nivel'));

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estudiantes  $estudiantes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Buscar el estudiante por su ID
        $estudiante = Estudiante::find($id);

        // Verificar si el estudiante existe
        if (!$estudiante) {
            return redirect()->route('estudiantes.index')->with('error', 'Estudiante no encontrado');
        }

        // Eliminar el estudiante
        $estudiante->delete();

        // Redireccionar a la vista de index con un mensaje de éxito
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado correctamente');
    }
}
