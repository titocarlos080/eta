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
        return view('carreras.index', compact('carreras'));
    }

    public function create()
    {
        $gestiones = Gestion::all(); // Para el dropdown de gestiones
        return view('carreras.create', compact('gestiones'));
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

    public function edit(Carrera $carrera)
    {
        $gestiones = Gestion::all(); // Para el dropdown de gestiones
        return view('carreras.edit', compact('carrera', 'gestiones'));
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
