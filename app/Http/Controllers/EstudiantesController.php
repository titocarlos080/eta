<?php

namespace App\Http\Controllers;
use App\Models\Carreras;
use App\Models\Estudiantes;
use App\Models\Niveles;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes = Estudiantes::with('carreras')->orderBy('id', 'asc')->paginate(9);
       // $carreras=Carreras::all();
       $carreras = Carreras::with('niveles')->get(); // Incluye los niveles
       
        return view('estudiantes.index', compact('estudiantes','carreras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estudiantes = Estudiantes::get();
        
         $carreras = Carreras::with('niveles')->get();

        return view('estudiantes.create', compact('estudiantes','carreras','niveles'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    $request->validate([
        'nombre' => 'required',
        'apellidos' => 'required',
        'carnet' => 'required',
        'carrera_nivel' => 'required', 
    ]);

    $estudiante = Estudiantes::create([
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estudiantes  $estudiantes
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiantes $estudiantes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estudiantes  $estudiantes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estudiante = Estudiantes::with('carreras.niveles')->find($id);
        $carreras = Carreras::with('niveles')->get();
            return response()->json([
            'estudiante' => $estudiante,
            'carreras' => $carreras
         ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudiantes  $estudiantes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'carnet' => 'required',
            'carrera_nivel' => 'required',
        ]);

        $estudiante = Estudiantes::find($id);
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
    public function destroy(Estudiantes $estudiantes)
    {
        //
    }
}
