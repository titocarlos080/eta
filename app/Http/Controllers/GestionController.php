<?php

namespace App\Http\Controllers;

use App\Models\Gestion;
use App\Models\Pagina;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    public function index(Request $request)
    {     Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
        $search= $request->get('search');
        $gestiones = Gestion::where('descripcion', 'like', "%{$search}%")->get();
        return view('gestiones.index', compact('gestiones','visitas','search') );
    }

    public function create(Request $request)
    {
        Pagina::contarPagina(request()->path());
        $pagina = Pagina::where('path', request()->path())->first();
        $visitas = $pagina ? $pagina->visitas : 0;
        $search= $request->get('search');
        $gestiones = Gestion::where('descripcion', 'like', "%{$search}%")->get();
        return view('gestiones.index', compact('gestiones','visitas','search') );
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
        ]);

        Gestion::create($request->all());

        return redirect()->route('gestiones.index')->with('success', 'Gestión creada exitosamente.');
    }

    public function show(Gestion $gestion)
    {
        return view('gestiones.show', compact('gestion'));
    } 

    public function edit($codigo)
    {
        $gestion = Gestion::find($codigo);
        return response()->json($gestion);

       
    }
    

    public function update(Request $request,  $gestion)
    {
      
        $materia = Gestion::find($gestion);
        $materia->update($request->all());

         

        return redirect()->route('gestiones.index')->with('success', 'Gestión actualizada exitosamente.');
    }

    public function destroy($codigo)
    {
        $gestion = Gestion::where('codigo', $codigo)->firstOrFail();
        $gestion->delete();
    
        return redirect()->route('gestiones.index')->with('success', 'Gestión eliminada exitosamente.');
    }
    
}
