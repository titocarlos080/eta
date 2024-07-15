<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Gestion;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public function index()
    {
        $carreras = Carrera::all();
        $gestiones = Gestion::all(); // Obtén todas las gestiones
        return view('carreras.index', compact('carreras', 'gestiones'));
    }

    public function create()
    {
        $carreras = Carrera::all();
        $gestiones = Gestion::all(); // Obtén todas las gestiones
        return view('carreras.index', compact('carreras', 'gestiones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sigla' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'gestion_codigo' => 'required|integer|exists:gestiones,codigo',
        ]);

        Carrera::create($request->all());

        return redirect()->route('carreras.index')->with('success', 'Carrera creada exitosamente.');
    }

    public function show(Carrera $carrera)
    {
        return view('carreras.show', compact('carrera'));
    }

    public function edit($codigo)
    {
        $carrera = Carrera::find($codigo);
        return response()->json($carrera);
    }

    public function update(Request $request, Carrera $carrera)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'gestion_codigo' => 'required|integer|exists:gestiones,codigo',
        ]);

        $carrera->update($request->all());

        return redirect()->route('carreras.index')->with('success', 'Carrera actualizada exitosamente.');
    }

    public function destroy(Carrera $carrera)
    {
        $carrera->delete();
        return redirect()->route('carreras.index')->with('success', 'Carrera eliminada exitosamente.');
    }
}
