<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Docente;
use App\Models\Gestion;
use App\Models\GrupoMateria;
use App\Models\Materia;
use App\Models\Oferta;
use Illuminate\Http\Request;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gestiones = Gestion::all();
         return view('ofertas.index', compact('gestiones'));
    }
    public function showCarreras($gestionCodigo)
{
    $gestion = Gestion::find($gestionCodigo);

    if (!$gestion) {
        return redirect()->route('ofertas.index')->with('error', 'Gestión no encontrada.');
    }

    $carreras = Carrera::where('gestion_codigo', $gestionCodigo)->get();
    return view('ofertas.carreras', compact('carreras', 'gestion'));
}

    

public function showMaterias(Request $request, $carreraSigla)
{
    $search = $request->get('search');
    $materias = Materia::join('grupo_materias', 'materias.sigla', '=', 'grupo_materias.materia_sigla')
        ->join('docentes', 'grupo_materias.docente_ci', '=', 'docentes.ci')
        ->where('grupo_materias.carrera_sigla', $carreraSigla)
        ->when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('materias.descripcion', 'like', "%{$search}%")
                    ->orWhere('grupo_materias.descripcion', 'like', "%{$search}%")
                    ->orWhere('docentes.nombre', 'like', "%{$search}%")
                    ->orWhere('docentes.apellido_pat', 'like', "%{$search}%")
                    ->orWhere('docentes.apellido_mat', 'like', "%{$search}%");
            });
        })
        ->select(
            'materias.sigla as materia_sigla',
            'materias.descripcion as materia_descripcion',
            'grupo_materias.descripcion as grupo_descripcion',
            'docentes.nombre as docente_nombre',
            'docentes.apellido_pat as docente_apellido_pat',
            'docentes.apellido_mat as docente_apellido_mat'
        )
        ->get();

    return view('ofertas.materias', compact('materias', 'search'));
}

    public function create()
    {
        $gestiones = Gestion::all();
        $carreras = Carrera::all();
        $materias = Materia::all();
        $grupos = GrupoMateria::all();
        $docentes = Docente::all();
        return view('ofertas.create', compact('gestiones', 'carreras', 'materias', 'grupos', 'docentes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gestion_codigo' => 'required',
            'carrera_sigla' => 'required',
            'materia_sigla' => 'required',
            'grupo_sigla' => 'required',
            'docente_ci' => 'required',
        ]);

        Oferta::create($request->all());

        return redirect()->route('ofertas.index')->with('success', 'Oferta creada exitosamente.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function show(Oferta $oferta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function edit(Oferta $oferta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Oferta $oferta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oferta $oferta)
    {
        //
    }
}
