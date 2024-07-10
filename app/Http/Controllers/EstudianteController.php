<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {        $usuarios = User::all();

        $estudiantes = Estudiante::all();
         return view('estudiantes.index', compact('estudiantes'),compact('usuarios'));
    }

    public function create()
    {
        $usuarios = User::all();
        return view('estudiantes.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ci' => 'required|string|max:20',
            'nombre' => 'nullable|string|max:255',
            'apellido_pat' => 'nullable|string|max:255',
            'apellido_mat' => 'nullable|string|max:255',
            'email' => 'required|email|unique:estudiantes,email',
            'telefono' => 'nullable|string|max:255',
            'sexo' => 'required|in:M,F',
            'fecha_nacimiento' => 'required|date',
            'usuario_id' => 'required|exists:users,id',
        ]);

        Estudiante::create($request->all());

        return redirect()->route('estudiantes.index')
                         ->with('success', 'Estudiante creado exitosamente.');
    }

    public function show(Estudiante $estudiante)
    {
        return view('estudiantes.show', compact('estudiante'));
    }

    public function edit(Estudiante $estudiante)
    {
        $usuarios = User::all();
        return view('estudiantes.edit', compact('estudiante', 'usuarios'));
    }

    public function update(Request $request, Estudiante $estudiante)
    {
        $request->validate([
            'ci' => 'required|string|max:20',
            'nombre' => 'nullable|string|max:255',
            'apellido_pat' => 'nullable|string|max:255',
            'apellido_mat' => 'nullable|string|max:255',
            'email' => 'required|email|unique:estudiantes,email,' . $estudiante->ci,
            'telefono' => 'nullable|string|max:255',
            'sexo' => 'required|in:M,F',
            'fecha_nacimiento' => 'required|date',
            'usuario_id' => 'required|exists:users,id',
        ]);

        $estudiante->update($request->all());

        return redirect()->route('estudiantes.index')
                         ->with('success', 'Estudiante actualizado exitosamente.');
    }

    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();
        return redirect()->route('estudiantes.index')
                         ->with('success', 'Estudiante eliminado exitosamente.');
    }
}
