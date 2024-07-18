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


        return view('grupo_materia_horarios.index', compact('grupos', 'grupoHorarios', 'horarios', 'dias', 'visitas'));
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


        return view('grupo_materia_horarios.index', compact('grupos', 'grupoHorarios', 'horarios', 'dias', 'visitas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar la entrada de datos
        $request->validate([
            'grupo_sigla' => 'required|string|max:255',
            'horario_id' => 'required|integer|exists:horarios,id',
            'dia_id' => 'required|integer|exists:dias,id',
        ], [
            'grupo_sigla.required' => 'El campo Grupo es obligatorio.',
            'grupo_sigla.string' => 'El campo Grupo debe ser una cadena de texto.',
            'grupo_sigla.max' => 'El campo Grupo no debe exceder de 255 caracteres.',
            'horario_id.required' => 'El campo Horario es obligatorio.',
            'horario_id.integer' => 'El campo Horario debe ser un número entero.',
            'horario_id.exists' => 'El horario seleccionado no es válido.',
            'dia_id.required' => 'El campo Día es obligatorio.',
            'dia_id.integer' => 'El campo Día debe ser un número entero.',
            'dia_id.exists' => 'El día seleccionado no es válido.',
        ]);

        // Crear una nueva instancia del modelo y asignar los valores del formulario
        $grupoMateriaHorario = new GrupoMateriaHorario();
        $grupoMateriaHorario->grupo_sigla = $request->grupo_sigla;
        $grupoMateriaHorario->horario_id = $request->horario_id;
        $grupoMateriaHorario->dia_id = $request->dia_id;

        // Guardar la nueva instancia en la base de datos
        $grupoMateriaHorario->save();

        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('grupo_materia_horarios.index')->with('success', 'Horario de grupo guardado exitosamente.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GrupoMateriaHorario  $grupoMateriaHorario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GrupoMateriaHorario  $grupoMateriaHorario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        // Buscar la instancia del modelo correspondiente al id
        $grupoMateriaHorario = GrupoMateriaHorario::findOrFail($id);
    
        // Eliminar la instancia
        $grupoMateriaHorario->delete();
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('grupo_materia_horarios.index')->with('success', 'Horario de grupo materia eliminado exitosamente.');
    }
}
