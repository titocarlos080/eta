<?php

namespace App\Http\Controllers;

use App\Models\Tematica;
use App\Models\Tematicas;
use Illuminate\Http\Request;

class TematicasController extends Controller
{
    // Muestra una lista de todos los recursos
    public function index()
    {
        $tematicas = Tematica::all();
        return view('tematicas.index', compact('tematicas'));
    }

    // Muestra el formulario para crear un nuevo recurso
    public function create()
    {
        return view('tematicas.create');
    }

    // Almacena un nuevo recurso en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:tematicas|max:255',
        ]);

        Tematica::create($request->all());
        return redirect()->route('tematicas.index')
                         ->with('success', 'Tematica creada exitosamente.');
    }

    // Muestra el recurso especificado
    public function show(Tematica $tematica)
    {
        return view('tematicas.show', compact('tematica'));
    }

    // Muestra el formulario para editar el recurso especificado
    public function edit(Tematica $tematica)
    {
        return view('tematicas.edit', compact('tematica'));
    }

    // Actualiza el recurso especificado en la base de datos
    public function update(Request $request, Tematica $tematica)
    {
        $request->validate([
            'nombre' => 'required|unique:tematicas,nombre,' . $tematica->id . '|max:255',
        ]);

        $tematica->update($request->all());
        return redirect()->route('tematicas.index')
                         ->with('success', 'Tematica actualizada exitosamente.');
    }

    // Elimina el recurso especificado de la base de datos
    public function destroy(Tematica $tematica)
    {
        $tematica->delete();
        return redirect()->route('tematicas.index')
                         ->with('success', 'Tematica eliminada exitosamente.');
    }
}
