<?php

namespace App\Http\Controllers;

use App\Models\Egreso;
use App\Models\Gestion;
use App\Models\Pagina;
use Illuminate\Http\Request;

class EgresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          // Contar visitas de la página actual
        Pagina::contarPagina(request()->path());
        $egresos = Egreso::all();
        $gestiones = Gestion::all(); 
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
      

        return view('egresos.index', compact('egresos', 'gestiones','visitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Contar visitas de la página actual
        Pagina::contarPagina(request()->path());

        $gestiones = Gestion::all(); // Obtén todas las gestiones
        // Obtener el número de visitas para la página actual
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;

        return view('egresos.create', compact('gestiones', 'visitas'));
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
            'monto' => 'required|numeric',
            'fecha' => 'required|date',
            'concepto' => 'required|string|max:255',
            'gestion_codigo' => 'required|exists:gestiones,codigo', // Asegura que el código de gestión exista
        ]);

        Egreso::create($request->all());

        return redirect()->route('egresos.index')->with('success', 'Egreso creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */

     public function anular(Request $request, $id)
     {
        $egreso = Egreso::findOrFail($id);
        $egreso->update(['anulado' => true]);

        return response()->json(['success' => true]);
     }
    public function show(Egreso $egreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function edit(Egreso $egreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Egreso $egreso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Egreso $egreso)
    {
        //
    }
}
