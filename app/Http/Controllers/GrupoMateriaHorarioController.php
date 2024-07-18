<?php

namespace App\Http\Controllers;

use App\Models\Dia;
use App\Models\GrupoMateria;
use App\Models\GrupoMateriaHorario;
use App\Models\Horario;
use App\Models\Pagina;
use Illuminate\Http\Request;

class GrupoMateriaHorarioController extends Controller
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

        $grupos = GrupoMateria::all();
        $grupoHorarios = GrupoMateriaHorario::all();
        $horarios = Horario::all();
        $dias = Dia::all();


        return view('grupo_materia_horarios.index', compact('grupos', 'grupoHorarios', 'horarios', 'dias','visitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;

        $grupos = GrupoMateria::all();
        $grupoHorarios = GrupoMateriaHorario::all();
        $horarios = Horario::all();
        $dias = Dia::all();


        return view('grupo_materia_horarios.index', compact('grupos', 'grupoHorarios', 'horarios', 'dias','visitas'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GrupoMateriaHorario  $grupoMateriaHorario
     * @return \Illuminate\Http\Response
     */
    public function show(  $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GrupoMateriaHorario  $grupoMateriaHorario
     * @return \Illuminate\Http\Response
     */
    public function edit(  $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GrupoMateriaHorario  $grupoMateriaHorario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GrupoMateriaHorario  $grupoMateriaHorario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
