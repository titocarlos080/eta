<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $materias = Materia::all();
 

         return view('materias.index',['materias'=>$materias]);
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
