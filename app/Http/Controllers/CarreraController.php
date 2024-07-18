<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Gestion;
use App\Models\Pagina;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Contar visitas de la página actual
        Pagina::contarPagina(request()->path());

       
        $gestiones = Gestion::all(); // Obtén todas las gestiones
        // Obtener el número de visitas para la página actual
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
        $search= $request->get('search');
        $carreras = Carrera::where('sigla', 'like', '%'.$search.'%')->orWhere('descripcion', 'like', '%'.$search.'%')->paginate(9);
        return view('carreras.index', compact('carreras', 'gestiones', 'visitas','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
          // Contar visitas de la página actual
          Pagina::contarPagina(request()->path());

          
          $gestiones = Gestion::all(); // Obtén todas las gestiones
          // Obtener el número de visitas para la página actual
          $pagina = Pagina::where('path', request()->path())->first();
          $visitas = $pagina ? $pagina->visitas : 0;
          $search= $request->get('search');
          $carreras = Carrera::where('sigla', 'like', '%'.$search.'%')->orWhere('descripcion', 'like', '%'.$search.'%')->paginate(9);
          return view('carreras.index', compact('carreras', 'gestiones', 'visitas','search'));
      }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del request
        $request->validate([
            'sigla' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'gestion_codigo' => 'required|integer|exists:gestiones,codigo',
        ]);

        // Crear una nueva carrera
        Carrera::create($request->all());

        return redirect()->route('carreras.index')->with('success', 'Carrera creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function show(Carrera $carrera)
    {
        // Contar visitas de la página actual
        Pagina::contarPagina(request()->path());

        return view('carreras.show', compact('carrera'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $codigo
     * @return \Illuminate\Http\Response
     */
    public function edit($codigo)
    {
        // Contar visitas de la página actual
        Pagina::contarPagina(request()->path());

        $carrera = Carrera::find($codigo);
        return response()->json($carrera);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carrera $carrera)
    {
        // Validar los datos del request
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'gestion_codigo' => 'required|integer|exists:gestiones,codigo',
        ]);

        // Actualizar la carrera
        $carrera->update($request->all());

        return redirect()->route('carreras.index')->with('success', 'Carrera actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Carrera  $carrera
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carrera $carrera)
    {
        // Eliminar la carrera
        $carrera->delete();
        return redirect()->route('carreras.index')->with('success', 'Carrera eliminada exitosamente.');
    }
}
