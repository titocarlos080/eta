<?php

namespace App\Http\Controllers;

use App\Models\Gestion;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    public function index()
    {
        $gestiones = Gestion::all();
        return view('gestiones.index', compact('gestiones'));
    }

    public function create()
    {
        return view('gestiones.create');
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

    public function edit(Gestion $gestion)
    {
        return view('gestiones.edit', compact('gestion'));
    }

    public function update(Request $request, Gestion $gestion)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date',
        ]);

        $gestion->update($request->all());

        return redirect()->route('gestiones.index')->with('success', 'Gestión actualizada exitosamente.');
    }

    public function destroy(Gestion $gestion)
    {
        $gestion->delete();
        return redirect()->route('gestiones.index')->with('success', 'Gestión eliminada exitosamente.');
    }
}
