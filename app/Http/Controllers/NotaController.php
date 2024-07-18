<?php

namespace App\Http\Controllers;

use App\Models\MateriaEstudiante;
use App\Models\Nota;
use App\Models\Pagina;
use Illuminate\Http\Request;

class NotaController extends Controller
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
        $notas= Nota::all();
         
         $materiaEstudiante= MateriaEstudiante::find( $notas,$visitas);
          return view('notas.index',$materiaEstudiante);


         
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function show($materia_estudiante_id)
    {   
         
        Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
         
         $materiaEstudiante= MateriaEstudiante::find( $materia_estudiante_id,$visitas);
          return view('notas.show',$materiaEstudiante);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function edit(Nota $nota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {      
        try {
            //code...
            $nota = Nota::updateOrCreate(
                ['estudiante_materia_id' => $request->input('materia_estudiante_id')],
                ['nota_final' => $request->input('nota_final')]
            );
            return redirect()->back()->with('success', 'Nota actualizada correctamente.');
     
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
        
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nota $nota)
    {
        //
    }
}
