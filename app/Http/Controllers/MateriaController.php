<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Pagina;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;

        $materias = Materia::all();
 

         return view('materias.index',compact('materias','visitas'));
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

        $materias = Materia::all();
 

         return view('materias.index',compact('materias','visitas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $materia = Materia::create($request->all());
        return redirect()->route('materias.index', $materia);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function show(Materia $materia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function edit($sigla)
    {
        $materia = Materia::find($sigla);
        return response()->json($materia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $sigla)
    {
         

        $materia = Materia::find($sigla);
        $materia->update($request->all());

        return redirect()->route('materias.index')->with('success', 'Materias actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy($sigla)
    {
         // Buscar el materia por su ID
         $materia = Materia::find($sigla);

         // Verificar si el materia existe
         if (!$materia) {
             return redirect()->route('materias.index')->with('error', 'Materia no encontrado');
         }
 
         // Eliminar el materia
         $materia->delete();
 
         // Redireccionar a la vista de index con un mensaje de éxito
         return redirect()->route('materias.index')->with('success', 'Materia eliminado correctamente');
   
    }
}
