<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\CarreraMateria;
use App\Models\Gestion;
use App\Models\Materia;
use App\Models\niveles;
use App\Models\Pagina;
use Illuminate\Http\Request;

class CarreraMateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();

        $visitas = $pagina ? $pagina->visitas : 0;
        $carreraMaterias = CarreraMateria::all();
        $niveles = niveles::all();
        $materias = Materia::all();
        $carreras = Carrera::all();
        return view('carrera_materias.index', compact('carreraMaterias', 'niveles', 'materias', 'carreras', 'visitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $niveles = niveles::all();
        $materias = Materia::all();
        $carreras = Carrera::all();
        return view('carrera_materias.create', compact('niveles', 'materias', 'carreras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'nivel_id' => 'required|exists:niveles,id',
            'materia_sigla' => 'required|exists:materias,sigla',
            'carrera_sigla' => 'required|exists:carreras,sigla',
        ], [
            'nivel_id.required' => 'El nivel es obligatorio.',
            'nivel_id.exists' => 'El nivel seleccionado no es válido.',
            'materia_sigla.required' => 'La materia es obligatoria.',
            'materia_sigla.exists' => 'La materia seleccionada no es válida.',
            'carrera_sigla.required' => 'La carrera es obligatoria.',
            'carrera_sigla.exists' => 'La carrera seleccionada no es válida.',
        ]);

        CarreraMateria::create([
            'nivel_id' => $validatedData['nivel_id'],
            'materia_sigla' => $validatedData['materia_sigla'],
            'carrera_sigla' => $validatedData['carrera_sigla'],
        ]);

        return redirect()->route('carrera_materias.index')->with('success', 'Materia en carrera creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarreraMateria  $carreraMateria
     * @return \Illuminate\Http\Response
     */

    //$carreraMateria->materia_sigla,$carreraMateria->carrera_sigla
    public function show($id)
    {
        $carreraMateria = CarreraMateria::findOrFail($id);
        return view('carrera_materias.show', compact('carreraMateria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarreraMateria  $carreraMateria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         
        $carreraMateria = CarreraMateria::find($id);
        return response()->json($carreraMateria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarreraMateria  $carreraMateria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nivel_id' => 'required|exists:niveles,id',
            'materia_sigla' => 'required|exists:materias,sigla',
            'carrera_sigla' => 'required|exists:carreras,sigla',
        ], [
            'nivel_id.required' => 'El nivel es obligatorio.',
            'nivel_id.exists' => 'El nivel seleccionado no es válido.',
            'materia_sigla.required' => 'La materia es obligatoria.',
            'materia_sigla.exists' => 'La materia seleccionada no es válida.',
            'carrera_sigla.required' => 'La carrera es obligatoria.',
            'carrera_sigla.exists' => 'La carrera seleccionada no es válida.',
        ]);
        $carreraMateria = CarreraMateria::findOrFail($id);
        $carreraMateria->update([
            'nivel_id' => $validatedData['nivel_id'],
            'materia_sigla' => $validatedData['materia_sigla'],
            'carrera_sigla' => $validatedData['carrera_sigla'],
        ]);

        return redirect()->route('carrera_materias.index')->with('success', 'Materia en carrera actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarreraMateria  $carreraMateria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carreraMateria = CarreraMateria::findOrFail($id);


        $carreraMateria->delete();

        return redirect()->route('carrera_materias.index')
            ->with('success', 'Carrera Materia eliminada con éxito');
    }
}
